<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use App\Services\BudgetService;
use App\Services\CategoryService;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BudgetController extends Controller
{

    /**
     * @var BudgetService
     */
    private BudgetService $budgetService;
    /**
     * @var CurrencyService
     */
    private CurrencyService $currencyService;

    /**
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * @param BudgetService $budgetService
     * @param CurrencyService $currencyService
     * @param CategoryService $categoryService
     */
    public function __construct(BudgetService $budgetService, CurrencyService $currencyService, CategoryService $categoryService)
    {
        $this->budgetService = $budgetService;
        $this->currencyService = $currencyService;
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */

    public function index(): View
    {
        $data['title'] = 'Budgets';
        $data['activeMenu'] = 'budget';
        $data['currencies'] = $this->currencyService->getAll();
        $data['categories'] = $this->categoryService->getCategoryByType('expense');
        $data['budgets'] = $this->budgetService->all();
        return view('admin.budget.index', $data);
    }


    public function store(StoreBudgetRequest $request)
    {
        $data = $request->validated();
        $this->budgetService->store($data);
        notyf()->success('New budget has been added');
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */

    public function edit(int $id): JsonResponse
    {
        $budget = $this->budgetService->findById($id);
        $selectedCategoryIds = [];
        foreach ($budget->categories as $selectedCategory)
        {
            $selectedCategoryIds[] = $selectedCategory->id;
        }
        return response()->json([
            'budget' => $budget,
            'selectedCategoryIds' => $selectedCategoryIds,
        ]);
    }

    /**
     * @param UpdateBudgetRequest $request
     * @param int $id
     */
    public function update(UpdateBudgetRequest $request)
    {
        $data = $request->validated();
        $this->budgetService->update($data, $request->id);
        notyf()->success('Budget has been updated');
        return redirect()->back();
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->budgetService->delete($id);
        notyf()->error('Budget has been deleted');
        return redirect()->back();
    }
}
