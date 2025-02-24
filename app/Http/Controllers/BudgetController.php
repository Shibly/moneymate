<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use App\Services\CategoryService;
use App\Services\CurrencyService;

class BudgetController extends Controller
{


    private CurrencyService $currencyService;

    protected CategoryService $categoryService;

    public function __construct(CurrencyService $currencyService, CategoryService $categoryService)
    {
        $this->currencyService = $currencyService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Budgets';
        $data['activeMenu'] = 'budget';
        $data['currencies'] = $this->currencyService->getAll();
        $data['categories'] = $this->categoryService->getCategoryByType('expense');
        return view('admin.budget.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBudgetRequest $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
