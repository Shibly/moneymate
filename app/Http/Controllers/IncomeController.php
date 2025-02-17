<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income;
use App\Services\BankAccountService;
use App\Services\CategoryService;
use App\Services\CurrencyService;
use App\Services\IncomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class IncomeController extends Controller
{
    protected CategoryService $categoryService;
    protected CurrencyService $currencyService;
    protected IncomeService $incomeService;

    protected BankAccountService $bankAccountService;

    public function __construct(IncomeService      $incomeService,
                                CategoryService    $categoryService,
                                CurrencyService    $currencyService,
                                BankAccountService $bankAccountService,
    )
    {
        $this->incomeService = $incomeService;
        $this->categoryService = $categoryService;
        $this->currencyService = $currencyService;
        $this->bankAccountService = $bankAccountService;
    }


    public function index()
    {
        $activeMenu = 'incomes';
        $incomes = $this->incomeService->allIncomes();
        $categories = $this->categoryService->allIncomes();
        $currencies = $this->currencyService->getAll();
        $bankAccounts = $this->bankAccountService->getAll();



        return view('admin.incomes.index', compact('activeMenu', 'incomes', 'categories', 'currencies', 'bankAccounts'));
    }


    public function store(StoreIncomeRequest $request)
    {
        $this->incomeService->create($request);
        return redirect()->route('incomes.index');
    }

    /**
     * @param UpdateIncomeRequest $request
     * @param Income $income
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateIncomeRequest $request, Income $income): JsonResponse
    {
        $updatedIncome = $this->incomeService->update($request, $income);
        return response()->json(['income' => $updatedIncome]);
    }


    /**
     * @param Income $income
     * @return Response
     * @throws \Exception
     */
    public function destroy(Income $income): Response
    {
        $this->incomeService->delete($income);
        return response()->noContent();
    }

    /**
     * @param Income $income
     * @return JsonResponse
     */
    public function show(Income $income): JsonResponse
    {
        return response()->json(['income' => $income]);
    }
}
