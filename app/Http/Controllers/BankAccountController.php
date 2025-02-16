<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use App\Services\BankService;
use App\Services\CurrencyService;

class BankAccountController extends Controller
{


    private BankAccountService $bankAccountService;
    private CurrencyService $currencyService;
    private BankService $bankService;

    public function __construct(bankAccountService $bankAccountService, CurrencyService $currencyService, BankService $bankService)
    {
        $this->bankAccountService = $bankAccountService;
        $this->currencyService = $currencyService;
        $this->bankService = $bankService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankAccounts = $this->bankAccountService->getByUserId(auth()->user()->id);
        $activeMenu = 'bank-accounts';
        $currencies = $this->currencyService->getAll();
        $banks = $this->bankService->getAll();

        return view('admin.bank-accounts.index', compact('bankAccounts', 'activeMenu', 'currencies', 'banks'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankAccountRequest $request)
    {
        $this->bankAccountService->store($request);
        notyf()->success('Bank Account has been created');
        return redirect()->route('accounts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $bankAccount = $this->bankAccountService->getById($id);

        if ($bankAccount) {
            return response()->json([
                'success' => true,
                'data' => $bankAccount
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Bank account not found'
            ], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount = $this->bankAccountService->update($bankAccount, $request);
        return response()->json($bankAccount);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bankAccountId)
    {
        $this->bankAccountService->delete($bankAccountId);
        return response()->json(null, 204);
    }
}
