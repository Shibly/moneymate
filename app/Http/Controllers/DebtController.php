<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDebtCollectionRequest;
use App\Http\Requests\StoreDebtRequest;
use App\Http\Requests\StoreRepaymentRequest;
use App\Http\Requests\UpdateDebtRequest;
use App\Models\Debt;
use App\Services\BankAccountService;
use App\Services\CurrencyService;
use App\Services\DebtLoanService;
use Illuminate\View\View;
use Exception;

class DebtController extends Controller
{

    private DebtLoanService $debtLoanService;
    private BankAccountService $bankAccountService;

    private CurrencyService $currencyService;

    public function __construct(DebtLoanService $debtLoanService, BankAccountService $bankAccountService, CurrencyService  $currencyService)
    {
        $this->debtLoanService = $debtLoanService;
        $this->bankAccountService = $bankAccountService;
        $this->currencyService = $currencyService;
    }

    /**
     * @return View
     * display listing
     */
    public function index(): View
    {
        $data['title'] = 'Debts/Loans';
        $data['activeMenu'] = 'debt-loan';
        $data['debts'] = $this->debtLoanService->getAll();
        $data['currencies'] = $this->currencyService->getAll();
        $data['bankAccounts'] = $this->bankAccountService->getByUserId(auth()->user()->id);
        return view('admin.debt.index', $data);
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
    public function store(StoreDebtRequest $request)
    {
        $data = $request->validated();
        try {
           $this->debtLoanService->store($data);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * @param int $id
     * @return View
     */

    public function show(int $id): View
    {
        $data['activeMenu'] = 'debt-loan';
        $data['debt'] = $this->debtLoanService->getById($id);

        $data['currencies'] = $this->currencyService->getAll();
        $data['bankAccounts'] = $this->bankAccountService->getByUserId(auth()->user()->id);

        if ($data['debt']->type == 'lend')
        {
            $data['title'] = 'Manage lend';
            return view('admin.debt.lend', $data);
        } else {
            $data['title'] = 'Manage Borrow';
            return view('admin.debt.borrow', $data);
        }

    }

    /**
     * @param StoreDebtCollectionRequest $request
     * @param $debt_id
     * @return \Illuminate\Http\JsonResponse|void
     */

    public function storeDebtCollection(StoreDebtCollectionRequest $request, $debt_id)
    {
        $data = $request->validated();
        try {
            $this->debtLoanService->storeDebtCollection($data, $debt_id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function storeRepay(StoreRepaymentRequest $request, $debt_id)
    {
        $data = $request->validated();

        try {
            $this->debtLoanService->storeRepayment($data, $debt_id);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDebtRequest $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id): mixed
    {
        $this->debtLoanService->destroy($id);
        return true;

    }
}
