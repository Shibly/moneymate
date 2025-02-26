<?php

namespace App\Traits;

use App\Models\BankAccount;
use App\Models\Budget;
use App\Models\Currency;
use App\Models\Debt;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;

trait DashboardWidgets
{

    /**
     * @return string
     */
    /**
     * Retrieve the default currency from the database.
     *
     * @return Currency|null
     */
    private function getDefaultCurrency()
    {
        return Currency::where('is_default', 'yes')
            ->orderBy('id', 'DESC')
            ->select('name', 'exchange_rate')
            ->first();
    }

    /**
     * Get the total of this month's incomes, converted into the default currency.
     *
     * @return string
     */
    public function getMonthlyIncomes(): string
    {
        $incomes = Income::whereMonth('income_date', date('m'))
            ->whereYear('income_date', date('Y'))
            ->where('user_id', auth()->id())
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $incomeOfThisMonth = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        // Only calculate if a default currency is found and has a valid exchange rate
        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($incomes as $income) {
                $incomeOfThisMonth += $income->usd_amount * $defaultCurrency->exchange_rate;
            }

            return number_format($incomeOfThisMonth, 0) . ' ' . $defaultCurrency->name;
        }

        // Fallback in case there is no default currency or exchange rate is invalid
        return 'No default currency set or invalid exchange rate.';
    }

    public function getMonthlyExpenses(): string
    {
        $expenses = Expense::whereMonth('expense_date', date('m'))
            ->whereYear('expense_date', date('Y'))
            ->where('user_id', auth()->id())
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $expenseOfThisMonth = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        // Only calculate if a default currency is found and has a valid exchange rate
        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($expenses as $expense) {
                $expenseOfThisMonth += $expense->usd_amount * $defaultCurrency->exchange_rate;
            }

            return number_format($expenseOfThisMonth, 0) . ' ' . $defaultCurrency->name;
        }

        // Fallback in case there is no default currency or exchange rate is invalid
        return 'No default currency set or invalid exchange rate.';
    }


    /**
     * Get the total account balance across all user bank accounts,
     * converted into the default currency.
     *
     * @return string
     */
    public function getTotalAccountBalance(): string
    {
        $bankAccounts = BankAccount::where('user_id', auth()->id())
            ->with('currency')
            ->select('id', 'currency_id', 'usd_balance')
            ->get();

        $balance = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($bankAccounts as $account) {
                $balance += $account->usd_balance * $defaultCurrency->exchange_rate;
            }

            return number_format($balance, 0) . ' ' . $defaultCurrency->name;
        }
        return 'No default currency set or invalid exchange rate.';
    }


    /**
     * @return string
     */
    public function getTotalLends(): string
    {


        $lends = Debt::where('user_id', auth()->id())->where('type', 'lend')
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')->get();

        $totalLends = 0;
        $defaultCurrency = $this->getDefaultCurrency();
        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($lends as $lend) {
                $totalLends += $lend->usd_amount * $defaultCurrency->exchange_rate;
            }
            return number_format($totalLends, 0) . ' ' . $defaultCurrency->name;
        }
        return 'No default currency set or invalid exchange rate.';

    }

    public function getTotalBorrows()
    {
    }


    public function getIncomeVsExpenseFromSixMonths(): array
    {
        /**
         * For last 6 months data only including the current month
         */
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(now()->subMonths($i)->format('Y-m'));
        }

        $incomes = [];
        $expenses = [];
        $defaultCurrency = $this->getDefaultCurrency();


        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {

            foreach ($months as $month) {
                $income = Income::whereMonth('income_date', date('m', strtotime($month)))
                    ->whereYear('income_date', date('Y', strtotime($month)))
                    ->where('user_id', auth()->id())
                    ->sum('usd_amount');

                $expense = Expense::whereMonth('expense_date', date('m', strtotime($month)))
                    ->whereYear('expense_date', date('Y', strtotime($month)))
                    ->where('user_id', auth()->id())
                    ->sum('usd_amount');

                $incomes[] = $income * $defaultCurrency->exchange_rate;
                $expenses[] = $expense * $defaultCurrency->exchange_rate;
            }
        } else {
            return [
                'months' => $months->toArray(),
                'incomes' => ['No valid exchange rate'],
                'expenses' => ['No valid exchange rate'],
            ];
        }

        return [
            'months' => $months->toArray(),
            'incomes' => $incomes,
            'expenses' => $expenses,
        ];
    }


    public function showCurrentMonthBudgetDistribution()
    {

        $userId = auth()->id();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $budget = Budget::where('user_id', $userId)
            ->whereYear('start_date', $currentYear)
            ->whereMonth('start_date', $currentMonth)
            ->first();

        if (!$budget) {
            return view('budget.distribution', [
                'distribution' => [],
                'freePercentage' => 0,
                'freeAmount' => 0,
                'totalBudget' => 0,
            ]);
        }


        $totalBudget = $budget->amount;

        $categorySums = $budget->budgetExpenses()
            ->selectRaw('category_id, SUM(amount) as totalSpent')
            ->groupBy('category_id')
            ->pluck('totalSpent', 'category_id');


        $distribution = [];
        $usedAmount = 0;

        foreach ($budget->categories as $category) {
            $spent = $categorySums[$category->id] ?? 0;
            $usedAmount += $spent;


            $percentage = ($totalBudget > 0)
                ? ($spent / $totalBudget) * 100
                : 0;

            $distribution[] = [
                'name' => $category->name,
                'color' => $category->category_color,
                'spent' => $spent,
                'percentage' => $percentage
            ];
        }

        
        $freeAmount = $totalBudget - $usedAmount;
        $freeAmount = ($freeAmount < 0) ? 0 : $freeAmount;
        $freePercentage = ($totalBudget > 0)
            ? ($freeAmount / $totalBudget) * 100
            : 0;

        $data = [
            'distribution' => $distribution,
            'freePercentage' => $freePercentage,
            'freeAmount' => $freeAmount,
            'totalBudget' => $totalBudget,
        ];

        return $data;
    }


}
