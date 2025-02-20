<?php


namespace App\Services;

use App\Models\AccountTransfer;
use App\Models\BankAccount;
use App\Models\Currency;
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

    public function getAll(){
        return $this->accountTransferRepository->getAll();
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
                throw new Exception('Insufficient balance in the from account.');
            }


            $usdAmount = $this->convertToUsdAmount($fromAccount->currency_id, $amount);

            // Update balances
            $this->updateBalances($fromAccount, $toAccount, $amount, $usdAmount);
            // Create a transfer record
            $transfer = $this->createTransferRecord($fromAccount->id, $toAccount->id, $amount, $usdAmount, $transferDate, $note);

            DB::commit();

            return $transfer;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Failed to transfer amount: ' . $e->getMessage());
        }
    }

    private function convertToUsdAmount($currencyId, $amount)
    {
        $currency = Currency::find($currencyId);
        if ($currency->is_based == 'yes')
        {
            return $amount;
        } else {
            if ($currency->exchange_rate > 0)
            {
                return $amount / $currency->exchange_rate;
            } else {
                return $amount;
            }

        }
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
        $currency = Currency::find($currencyId);
        if ($currency->is_based == 'yes')
        {
            return $usdAmount;
        } else {
            return $usdAmount * $currency->exchange_rate;
        }
    }

    private function createTransferRecord($fromAccountId, $toAccountId, $amount, $usdAmount, $transferDate, $note)
    {
        $toAccount = BankAccount::find($toAccountId);

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
