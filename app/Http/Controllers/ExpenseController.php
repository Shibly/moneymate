<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Services\BankAccountService;
use App\Services\CategoryService;
use App\Services\CurrencyService;
use App\Services\ExpenseService;

class ExpenseController extends Controller
{
    /**
     * @var ExpenseService
     */
    private ExpenseService $expenseService;
    private BankAccountService $bankAccountService;

    private CurrencyService $currencyService;

    protected CategoryService $categoryService;

    public function __construct(ExpenseService $expenseService, BankAccountService $bankAccountService, CurrencyService $currencyService, CategoryService $categoryService)
    {
        $this->expenseService = $expenseService;
        $this->bankAccountService = $bankAccountService;
        $this->currencyService = $currencyService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = 'Expense Histories';
        $data['activeMenu'] = 'expenses';
        $data['bankAccounts'] = $this->bankAccountService->getByUserId(auth()->user()->id);
        $data['currencies'] = $this->currencyService->getAll();
        $data['categories'] = $this->categoryService->getCategoryByType('expense');
        $data['expenses'] = $this->expenseService->all();
        return view('admin.expenses.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $this->expenseService->store($request);
        notyf()->success('New expense information has been added');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): bool
    {
        $this->expenseService->delete($id);
        notyf()->error('Expense has been deleted successfully');
        return true;
    }
}
