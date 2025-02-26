<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ExpenseReportRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExpenseReportController extends Controller
{
    protected ExpenseReportRepositoryInterface $expenseReportRepository;

    public function __construct(ExpenseReportRepositoryInterface $expenseReportRepository)
    {
        $this->expenseReportRepository = $expenseReportRepository;
    }


    public function index(Request $request)
    {
        $activeMenu = 'expense-report';
        $title = 'Expense Report';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $expenses = $this->expenseReportRepository->getExpensesBetweenDates($startDate, $endDate, auth()->user()->id);
        return view('admin.reports.expense', compact('expenses', 'startDate', 'endDate', 'activeMenu', 'title'));
    }


    /**
     * Download the Excel for the filtered incomes.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportExcel(Request $request): BinaryFileResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomes = $this->expenseReportRepository->getExpensesBetweenDates(
            $startDate,
            $endDate,
            auth()->id()
        );

        // Export to Excel using the repository
        return $this->expenseReportRepository->exportToExcel($incomes);
    }

}
