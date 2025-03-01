<?php

namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\Expense;
use App\Repositories\Contracts\ExpenseInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpenseRepository implements ExpenseInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Expense::where('user_id', auth()->id())->get();
    }

    public function find(int $id): Collection
    {
        return Expense::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */

    public function store(array $data): mixed
    {
        $usd_amount = convert_to_usd_amount($data['currency_id'], $data['amount']);

        $budgetCategory = BudgetCategory::where('category_id', $data['category_id'])->first();
        if ($budgetCategory) {
            $budget = Budget::find($budgetCategory->budget_id);
            $exchange_budge_amount = convert_to_exchange_amount($budget->currency_id, $usd_amount);
            if ($budget && ($exchange_budge_amount > $budget->updated_amount)) {
                throw new Exception(get_translation('you_do_not_have_enough_budget_to_spend'));
            }
        }


        $bankAccount = BankAccount::find($data['account_id']);
        $exchange_amount = convert_to_exchange_amount($bankAccount->currency_id, $usd_amount);
        $expenseDate = Carbon::parse($data['expense_date'])->format('Y-m-d');

        DB::beginTransaction();
        try {
            $expense = Expense::create([
                'user_id' => Auth::user()->id,
                'account_id' => $data['account_id'],
                'currency_id' => $data['currency_id'],
                'amount' => $data['amount'],
                'exchange_amount' => $exchange_amount,
                'usd_amount' => $usd_amount,
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'note' => $data['note'],
                'reference' => $data['reference'],
                'expense_date' => $expenseDate,
                'attachment' => $data['attachment']
            ]);

            $budgets = Budget::where('start_date', '<=', Carbon::now())
                ->with('categories')
                ->get();

            foreach ($budgets as $budget) {
                if ($budget->categories->contains('id', $data['category_id']) && $this->isWithinTimeRange($budget->start_date, $budget->end_date, $expenseDate)) {

                    $exchange_budge_amount = convert_to_exchange_amount($budget->currency_id, $usd_amount);

                    // Add entry to the new table
                    BudgetExpense::create([
                        'user_id' => Auth::user()->id,
                        'budget_id' => $budget->id,
                        'expense_id' => $expense['id'],
                        'category_id' => $expense['category_id'],
                        'currency_id' => $data['currency_id'],
                        'amount' => $exchange_budge_amount,
                        'usd_amount' => $usd_amount,
                    ]);


                    if (Carbon::parse($expense['created_at'])->isSameDay(Carbon::now())) {
                        $budget->updated_amount -= $exchange_budge_amount;
                        $budget->usd_amount -= $usd_amount;
                        $budget->save();
                    }
                }
            }

            $bankAccount->balance -= $exchange_amount;
            $bankAccount->usd_balance -= $usd_amount;
            $bankAccount->save();
            DB::commit();
            return $expense;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }

    }

    /**
     * @param int $id
     * @return bool
     */

    public function delete(int $id): bool
    {
        $expense = Expense::find($id);

        if (!$expense) {
            throw new Exception(get_translation('expense_not_found'));
        }

        DB::beginTransaction();
        try {
            $bankAccount = BankAccount::find($expense->account_id);
            $bankAccount->balance += $expense->exchange_amount;
            $bankAccount->usd_balance += $expense->usd_amount;
            $bankAccount->save();


            $budgetExpenses = BudgetExpense::where('expense_id', $expense->id)->get();

            foreach ($budgetExpenses as $budgetExpense) {
                $budget = Budget::find($budgetExpense->budget_id);

                if ($budget) {
                    // Restore budget amounts if the date matches
                    if (Carbon::parse($expense->created_at)->isSameDay(Carbon::now())) {
                        $budget->updated_amount += $budgetExpense->amount;
                        $budget->usd_amount += $budgetExpense->usd_amount;
                        $budget->save();
                    }
                }
                $budgetExpense->delete();
            }

            if (!empty($expense->attachment)) {
                Storage::delete($expense->attachment);
            }


            $expense->delete();
            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * Check if a given date is within the specified time range.
     *
     * @param string $start_date
     * @param string $end_date
     * @param string $date
     * @return bool
     */
    private function isWithinTimeRange(string $start_date, string $end_date, string $date): bool
    {
        $startDate = Carbon::createFromFormat('Y-m-d', trim($start_date))->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', trim($end_date))->endOfDay();
        $expenseDate = Carbon::createFromFormat('Y-m-d', trim($date))->startOfDay();

        return $expenseDate->between($startDate, $endDate);
    }

}
