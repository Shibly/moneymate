<?php

namespace App\Traits;

use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\Income;

trait DashboardWidgets
{

    /**
     * @return string
     */
    public function getMonthlyIncomes(): string
    {
        $incomes = Income::whereMonth('income_date', date('m'))
            ->whereYear('income_date', date('Y'))
            ->where('user_id', auth()->user()->id)
            ->with('currency')
            ->select('id', 'currency_id', 'usd_amount')
            ->get();

        $incomeOfThisMonth = 0;
        $defaultCurrency = Currency::where('is_default', 'yes')->orderBy('id', 'DESC')->select('name', 'exchange_rate')->first();

        foreach ($incomes as $income) {
            if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
                $incomeOfThisMonth += $income->usd_amount * $defaultCurrency->exchange_rate;
            }
        }

        return number_format($incomeOfThisMonth, 0) . ' ' . $defaultCurrency->name;
    }

    public function getMonthlyExpenses()
    {
    }


    /**
     * @return string
     */
    public function getTotalAccountBalance(): string
    {
        $bankAccounts = BankAccount::where('user_id', auth()->user()->id)
            ->with('currency')
            ->select('id', 'currency_id', 'usd_balance')
            ->get();

        $balance = 0;
        $defaultCurrency = Currency::where('is_default', 'yes')->orderBy('id', 'DESC')->select('name', 'exchange_rate')->first();

        foreach ($bankAccounts as $account) {
            if ($defaultCurrency && $defaultCurrency->exchange_rate > 0) {
                $balance += $account->usd_balance * $defaultCurrency->exchange_rate;
            }
        }

        return number_format($balance, 0) . ' ' . $defaultCurrency->name;
    }

    public function getTotalLends()
    {
    }

    public function getTotalBorrows()
    {
    }


}
