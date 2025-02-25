<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IncomeReportRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IncomeReportController extends Controller
{
    /**
     * @var IncomeReportRepositoryInterface
     */
    protected IncomeReportRepositoryInterface $incomeReportRepository;

    /**
     * Constructor with dependency injection.
     */
    public function __construct(IncomeReportRepositoryInterface $incomeReportRepository)
    {
        $this->incomeReportRepository = $incomeReportRepository;
    }

    /**
     * Show a view with the filtered list of incomes.
     *
     * @param Request $request
     * @return Factory|View|Application|object
     */
    public function index(Request $request)
    {
        $activeMenu = 'income-report';
        $title = 'Income Report';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomes = $this->incomeReportRepository->getIncomesBetweenDates(
            $startDate,
            $endDate,
            auth()->id()
        );
        return view('admin.reports.income', compact('incomes', 'startDate', 'endDate', 'activeMenu', 'title'));
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

        $incomes = $this->incomeReportRepository->getIncomesBetweenDates(
            $startDate,
            $endDate,
            auth()->id()
        );

        // Export to Excel using the repository
        return $this->incomeReportRepository->exportToExcel($incomes);
    }
}
