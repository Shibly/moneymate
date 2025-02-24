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
        $totalMonthlyExpense = $this->getMonthlyExpenses();
        $totalAccountBalances = $this->getTotalAccountBalance();
        $totalLends = $this->getTotalLends();
        $incomeData = $this->getIncomeVsExpenseFromSixMonths();
        return view('admin.dashboard', compact('activeMenu', 'title',
            'totalMonthlyIncome', 'totalAccountBalances', 'totalLends', 'totalMonthlyExpense', 'incomeData'));
    }
}
