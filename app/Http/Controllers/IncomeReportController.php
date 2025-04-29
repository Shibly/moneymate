<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IncomeReportRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    /**
     * @var IncomeReportRepositoryInterface
     */
    protected IncomeReportRepositoryInterface $incomeReportRepository;

    protected CategoryService $categoryService;

    /**
     * Constructor with dependency injection.
     */
    public function __construct(IncomeReportRepositoryInterface $incomeReportRepository, CategoryService $categoryService)
    {
        $this->incomeReportRepository = $incomeReportRepository;
        $this->categoryService = $categoryService;
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
        $selectedCategories = $request->input('categories', []);
        $incomeCategories = $this->categoryService->getCategoryByType('income');

        $incomes = $this->incomeReportRepository->getIncomesBetweenDates(
            $startDate,
            $endDate,
            auth()->id(),
            $selectedCategories
        );

        if ($request->action_type == 'export') {
            return $this->incomeReportRepository->exportToExcel($incomes);
        } else {
            return view('admin.reports.income', compact('incomes', 'startDate', 'endDate', 'incomeCategories', 'selectedCategories', 'activeMenu', 'title'));
        }


    }
}
