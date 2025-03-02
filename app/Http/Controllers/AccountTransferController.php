<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountTransferRequest;
use App\Models\AccountTransfer;
use App\Services\AccountTransferService;
use App\Services\BankAccountService;
use Exception;
use Illuminate\View\View;

class AccountTransferController extends Controller
{

    private AccountTransferService $accountTransferService;

    private BankAccountService $bankAccountService;

    public function __construct(AccountTransferService $accountTransferService, BankAccountService $bankAccountService)
    {
        $this->accountTransferService = $accountTransferService;
        $this->bankAccountService = $bankAccountService;
    }


    /**
     * @return View
     */

    public function balanceTransfer(): View
    {
        $data['activeMenu'] = 'balance-transfer';
        $data['title'] = get_translation('balance_transfer');
        $data['bankAccounts'] = $this->bankAccountService->getByUserId(auth()->user()->id);
        $data['accountTransfers'] = $this->accountTransferService->getAll();
        return view('admin.transfer.balance-transfer', $data);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function storeBalanceTransfer(StoreAccountTransferRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $this->accountTransferService->transferAmount(
                $validatedData['from_account_id'],
                $validatedData['to_account_id'],
                $validatedData['amount'],
                $validatedData['transfer_date'],
                $validatedData['note'] ?? null
            );
            notyf()->success(get_translation('balance_transferred_successfully'));
            return redirect()->route('transfer.balance');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(AccountTransfer $accountTransfer)
    {
        //
    }


}
