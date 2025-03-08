<?php

namespace App\Repositories\Eloquent;

use App\Models\Budget;
use App\Repositories\Contracts\BudgetInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BudgetRepository implements BudgetInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Budget::where('user_id', auth()->id())->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        $newStartDate = Carbon::parse($data['start_date']);
        $newEndDate = Carbon::parse($data['end_date']);

        // Check if the new budget overlaps with any existing budgets
        $existingBudgets = Auth::user()->budgets()->get();
        foreach ($existingBudgets as $existingBudget) {
            $existingStartDate = Carbon::parse($existingBudget->start_date);
            $existingEndDate = Carbon::parse($existingBudget->end_date);

            if (
                ($newStartDate >= $existingStartDate && $newStartDate <= $existingEndDate) ||
                ($newEndDate >= $existingStartDate && $newEndDate <= $existingEndDate) ||
                ($newStartDate <= $existingStartDate && $newEndDate >= $existingEndDate)
            ) {
                throw new Exception("The new budget overlaps with an existing budget. Please select a different date range");
            }
        }

        $usd_amount = convert_to_usd_amount($data['currency_id'], $data['amount']);

        DB::beginTransaction();
        try {
            // Create the budget
            $budget = Auth::user()->budgets()->create([
                'budget_name' => $data['budget_name'],
                'currency_id' => $data['currency_id'],
                'amount' => $data['amount'],
                'updated_amount' => $data['amount'],
                'usd_amount' => $usd_amount,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);

            // Attach categories to the budget
            $budget->categories()->attach($data['categories']);
            DB::commit();

            return $budget;

        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(array $data, int $id): mixed
    {
        $budget = Budget::findOrFail($id);


        $existing_updated_amount = $budget->updated_amount;
        $existing_usd_amount = $budget->usd_amount;
        $existing_original_amount = $budget->amount;


        if ($data['updated_amount'] > $existing_updated_amount) {
            $real_updated_amount = $data['updated_amount'] - $existing_updated_amount;
        } else {
            $real_updated_amount = 0;
        }


        $new_updated_amount = $existing_updated_amount + $real_updated_amount;
        $real_usd_amount = ($real_updated_amount > 0) ? convert_to_usd_amount($data['currency_id'], $real_updated_amount) : 0;
        $new_usd_amount = $existing_usd_amount + $real_usd_amount;
        $new_original_amount = $existing_original_amount + $real_updated_amount;
        $budget->update([
            'budget_name' => $data['budget_name'],
            'updated_amount' => $new_updated_amount,
            'usd_amount' => $new_usd_amount,
            'amount' => $new_original_amount,
            'currency_id' => $data['currency_id'],
            'start_date' => Carbon::parse($data['start_date'])->toDateString(),
            'end_date' => Carbon::parse($data['end_date'])->toDateString(),
            'user_id' => Auth::id(),
        ]);
        $budget->categories()->sync($data['categories']);

        return $budget;
    }



    /**
     * @param int $id
     * @return Budget
     */

    public function findById(int $id): Budget
    {
        return Budget::findOrFail($id);
    }

    /**
     * @param int $id
     * @return void
     */

    public function delete(int $id): void
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();
    }
}
