<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountTransferRequest;
use App\Models\AccountTransfer;
use App\Services\AccountTransferService;
use Exception;
use Illuminate\Http\JsonResponse;

class AccountTransferController extends Controller
{

    private AccountTransferService $accountTransferService;

    public function __construct(AccountTransferService $accountTransferService)
    {
        $this->accountTransferService = $accountTransferService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * @param StoreAccountTransferRequest $request
     * @return JsonResponse
     */
    public function transferAmount(StoreAccountTransferRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $transfer = $this->accountTransferService->transferAmount(
                $validatedData['from_account_id'],
                $validatedData['to_account_id'],
                $validatedData['amount'],
                $validatedData['transfer_date'],
                $validatedData['note'] ?? null
            );

            return response()->json([
                'message' => 'Amount transferred successfully.',
                'data' => $transfer,
            ]);
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountTransfer $accountTransfer)
    {
        //
    }
}
