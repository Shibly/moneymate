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
            ->select('id', 'name', 'exchange_rate')
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

    /**
     * @return string
     */
    public function getYearlyIncome(): string
    {
        $incomes = Income::whereYear('income_date', date('Y'))
            ->where('user_id', auth()->id())
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $incomeOfThisYear = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        // Calculate if default currency exists and exchange rate is valid
        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($incomes as $income) {
                $incomeOfThisYear += $income->usd_amount * $defaultCurrency->exchange_rate;
            }

            return number_format($incomeOfThisYear, 0) . ' ' . $defaultCurrency->name;
        }

        // Fallback message
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
     * @return string
     */
    public function getYearlyExpenses(): string
    {
        $expenses = Expense::whereYear('expense_date', date('Y'))
            ->where('user_id', auth()->id())
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $expenseOfThisYear = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        // Only calculate if a default currency is found and has a valid exchange rate
        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($expenses as $expense) {
                $expenseOfThisYear += $expense->usd_amount * $defaultCurrency->exchange_rate;
            }

            return number_format($expenseOfThisYear, 0) . ' ' . $defaultCurrency->name;
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


    public function getTotalLends(): string
    {
        return $this->getTotalDebtByType('lend');
    }

    public function getTotalBorrows(): string
    {
        return $this->getTotalDebtByType('borrow');
    }

    private function getTotalDebtByType(string $type): string
    {
        $debts = Debt::where('user_id', auth()->id())
            ->where('type', $type)
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $totalAmount = 0;
        $defaultCurrency = $this->getDefaultCurrency();

        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            foreach ($debts as $debt) {
                $totalAmount += $debt->usd_amount * $defaultCurrency->exchange_rate;
            }
            return number_format($totalAmount, 0) . ' ' . $defaultCurrency->name;
        }

        return 'No default currency set or invalid exchange rate.';
    }


    public function getIncomeVsExpenseFromCurrentYear(): array
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $months = collect();
        $incomes = [];
        $expenses = [];

        $defaultCurrency = $this->getDefaultCurrency();

        if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
            for ($i = 1; $i <= $currentMonth; $i++) {
                // Format: January-2025
                $monthLabel = Carbon::createFromDate($currentYear, $i, 1)->format('F-Y');
                $months->push($monthLabel);

                $income = Income::whereMonth('income_date', $i)
                    ->whereYear('income_date', $currentYear)
                    ->where('user_id', auth()->id())
                    ->sum('usd_amount');

                $expense = Expense::whereMonth('expense_date', $i)
                    ->whereYear('expense_date', $currentYear)
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



    public function showCurrentMonthBudgetDistribution(): array
    {
        $userId = auth()->id();
        $currentMonth = now()->month;
        $currentYear = now()->year;


        $budget = Budget::where('user_id', $userId)
            ->whereYear('start_date', $currentYear)
            ->whereMonth('start_date', $currentMonth)
            ->first();


        if (!$budget) {
            return [
                'distribution' => [],
                'freePercentage' => 0,
                'freeAmount' => 0,
                'totalBudget' => 0,
            ];
        }


        $defaultCurrency = $this->getDefaultCurrency();
        if (!$defaultCurrency || $defaultCurrency->exchange_rate <= 0) {
            return [
                'distribution' => [],
                'freePercentage' => 0,
                'freeAmount' => 0,
                'totalBudget' => 0,
                'error' => 'No valid default currency or exchange rate.',
            ];
        }
        $exchangeRate = $defaultCurrency->exchange_rate;

        $categorySumsUsd = $budget->budgetExpenses()
            ->selectRaw('category_id, SUM(usd_amount) as totalSpentUsd')
            ->groupBy('category_id')
            ->pluck('totalSpentUsd', 'category_id');


        $freeUsd = $budget->usd_amount;


        $usedAmountUsd = 0;
        foreach ($categorySumsUsd as $usdSpent) {
            $usedAmountUsd += $usdSpent;
        }


        $totalBudgetUsd = $usedAmountUsd + $freeUsd;
        $totalBudget = $totalBudgetUsd * $exchangeRate;

        $distribution = [];
        foreach ($budget->categories as $category) {
            $spentUsd = $categorySumsUsd[$category->id] ?? 0;
            $distribution[] = [
                'name' => $category->name,
                'color' => $category->category_color,
                'spentUsd' => $spentUsd,
            ];
        }

        $usedAmount = 0;
        foreach ($distribution as &$dist) {
            $spent = $dist['spentUsd'] * $exchangeRate;
            $dist['spent'] = $spent;
            $dist['percentage'] = ($totalBudget > 0)
                ? ($spent / $totalBudget) * 100
                : 0;

            $usedAmount += $spent;
            unset($dist['spentUsd']);
        }
        unset($dist);

        $freeAmount = $freeUsd * $exchangeRate;
        if ($freeAmount < 0) {
            $freeAmount = 0;
        }

        $freePercentage = ($totalBudget > 0)
            ? ($freeAmount / $totalBudget) * 100
            : 0;

        return [
            'distribution' => $distribution,
            'freePercentage' => $freePercentage,
            'freeAmount' => $freeAmount,
            'totalBudget' => $totalBudget,
            'currencyCode' => $defaultCurrency->name,
        ];
    }


    /**
     * @return int
     */
    public function getNumberOfBankAccounts(): int
    {
        return BankAccount::count();
    }


}
