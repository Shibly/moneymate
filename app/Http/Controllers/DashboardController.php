<?php

namespace App\Http\Controllers;

use App\Traits\DashboardWidgets;
use Illuminate\View\View;

class DashboardController extends Controller
{

    use DashboardWidgets;

    public function dashboard(): View
    {
        $activeMenu = "dashboard";
        $title = 'Dashboard';
        $totalMonthlyIncome = $this->getMonthlyIncomes();
        $totalYearlyIncome = $this->getYearlyIncome();
        $totalMonthlyExpense = $this->getMonthlyExpenses();
        $totalYearlyExpense = $this->getYearlyExpenses();
        $totalAccountBalances = $this->getTotalAccountBalance();
        $totalLends = $this->getTotalLends();
        $incomeData = $this->getIncomeVsExpenseFromCurrentYear();
        $budgetData = $this->showCurrentMonthBudgetDistribution();
        $numberOfBankAccounts = $this->getNumberOfBankAccounts();
        $totalBorrows = $this->getTotalBorrows();
        return view('admin.dashboard', compact('activeMenu', 'title',
            'totalMonthlyIncome', 'totalAccountBalances',
            'totalLends', 'totalMonthlyExpense', 'incomeData', 'budgetData',
            'numberOfBankAccounts', 'totalBorrows', 'totalYearlyIncome','totalYearlyExpense'));
    }
}
