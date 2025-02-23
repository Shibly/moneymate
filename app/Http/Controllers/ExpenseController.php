<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Services\BankAccountService;
use App\Services\CategoryService;
use App\Services\CurrencyService;

class ExpenseController extends Controller
{
    private BankAccountService $bankAccountService;

    private CurrencyService $currencyService;

    protected CategoryService $categoryService;

    public function __construct(BankAccountService $bankAccountService, CurrencyService $currencyService, CategoryService $categoryService)
    {
        $this->bankAccountService = $bankAccountService;
        $this->currencyService = $currencyService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Expenses';
        $data['activeMenu'] = 'expenses';
        $data['bankAccounts'] = $this->bankAccountService->getByUserId(auth()->user()->id);
        $data['currencies'] = $this->currencyService->getAll();
        $data['categories'] = $this->categoryService->getCategoryByType('expense');
        return view('admin.expense.index', $data);
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
    public function store(StoreExpenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
