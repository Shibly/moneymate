<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;

class BankAccountController extends Controller
{


    private BankAccountService $bankAccountService;

    public function __construct(bankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankAccounts = $this->bankAccountService->getByUserId(auth()->user()->id);
        return response()->json($bankAccounts);
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
    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = $this->bankAccountService->store($request);
        return response()->json($bankAccount, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankAccount $bankAccount)
    {
        //
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
    public function destroy(BankAccount $bankAccount)
    {
        $this->bankAccountService->delete($bankAccount);
        return response()->json(null, 204);
    }
}
