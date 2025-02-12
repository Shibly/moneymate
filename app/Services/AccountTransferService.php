<?php


namespace App\Services;

use App\Models\AccountTransfer;
use App\Repositories\Contracts\AccountTransferRepositoryInterface;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AccountTransferService
{
    private BankAccountRepositoryInterface $bankAccountRepository;
    private AccountTransferRepositoryInterface $accountTransferRepository;

    public function __construct(
        BankAccountRepositoryInterface     $bankAccountRepository,
        AccountTransferRepositoryInterface $accountTransferRepository
    )
    {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->accountTransferRepository = $accountTransferRepository;
    }

    public function transferAmount($fromAccountId, $toAccountId, $amount, $transferDate, $note): AccountTransfer
    {
        // Ensure the transfer isn't between the same account
        if ($fromAccountId === $toAccountId) {
            throw new Exception('Cannot transfer amount between the same account.');
        }

        DB::beginTransaction();

        try {
            $fromAccount = $this->bankAccountRepository->lockForUpdate($fromAccountId);
            $toAccount = $this->bankAccountRepository->lockForUpdate($toAccountId);

            // Validate sufficient balance
            if ($fromAccount->balance < $amount) {
                throw new ValidationException('Insufficient balance in the from account.');
            }

            $usdAmount = $this->convertToUsdAmount($fromAccount->currency_id, $amount);

            // Update balances
            $this->updateBalances($fromAccount, $toAccount, $amount, $usdAmount);

            // Create a transfer record
            $transfer = $this->createTransferRecord($fromAccountId, $toAccountId, $amount, $usdAmount, $transferDate, $note);

            DB::commit();

            return $transfer;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to transfer amount: ' . $e->getMessage());
        }
    }

    private function convertToUsdAmount($currencyId, $amount)
    {
        // Logic to convert amount to USD (could be a service or helper function)
        return $amount; // Placeholder for conversion logic
    }

    private function updateBalances($fromAccount, $toAccount, $amount, $usdAmount)
    {
        $fromAccount->balance -= $amount;
        $fromAccount->usd_balance -= $usdAmount;
        $fromAccount->save();

        $toAccount->balance += $this->convertToExchangeAmount($toAccount->currency_id, $usdAmount);
        $toAccount->usd_balance += $usdAmount;
        $toAccount->save();
    }

    private function convertToExchangeAmount($currencyId, $usdAmount)
    {
        // Convert USD to the target currency
        return $usdAmount; // Placeholder for conversion logic
    }

    private function createTransferRecord($fromAccountId, $toAccountId, $amount, $usdAmount, $transferDate, $note)
    {
        $transfer = new AccountTransfer();
        $transfer->user_id = auth()->user()->id;
        $transfer->from_account_id = $fromAccountId;
        $transfer->to_account_id = $toAccountId;
        $transfer->amount = $amount;
        $transfer->usd_amount = $usdAmount;
        $transfer->exchange_amount = $this->convertToExchangeAmount($toAccount->currency_id, $usdAmount);
        $transfer->transfer_date = $transferDate;
        $transfer->note = $note;
        $transfer->save();

        return $transfer;
    }
}
