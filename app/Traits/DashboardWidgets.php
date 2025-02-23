<?php

namespace App\Traits;

use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\Debt;
use App\Models\Income;

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

    public function getMonthlyExpenses()
    {
        // Your logic for monthly expenses, if needed
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


}
