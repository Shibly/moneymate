<?php

// app/Services/IncomeService.php

namespace App\Services;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\BankAccount;
use App\Models\Income;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class IncomeService
{
    protected IncomeRepositoryInterface $incomeRepository;
    protected CurrencyConversionService $currencyConversionService;

    public function __construct(IncomeRepositoryInterface $incomeRepository, CurrencyConversionService $currencyConversionService)
    {
        $this->incomeRepository = $incomeRepository;
        $this->currencyConversionService = $currencyConversionService;
    }

    /**
     * Handle file upload for attachments.
     */
    private function handleAttachmentUpload($request, Income $income = null): ?string
    {
        if ($request->hasFile('attachment')) {
            // Delete the old attachment if updating
            if ($income) {
                Storage::delete($income->attachment);
            }

            $attachmentFile = $request->file('attachment');
            $filename = time() . '.' . $attachmentFile->getClientOriginalExtension();
            $attachmentFile->storeAs('files', $filename);

            return $filename;
        }

        return $income?->attachment;
    }

    /**
     * Create a new income record with transaction.
     */
    public function create(StoreIncomeRequest $request): Income
    {
        DB::beginTransaction(); // Start transaction

        try {
            $data = $request->validated();

            // Handle attachment file upload
            $attachment = $this->handleAttachmentUpload($request);

            // Convert the amounts
            $usdAmount = $this->currencyConversionService->convertToUsdAmount($request->currency_id, $request->amount);
            $bankAccount = BankAccount::find($request->account_id);
            $exchangeAmount = $this->currencyConversionService->convertToExchangeAmount($bankAccount->currency_id, $usdAmount);

            $incomeDate = Carbon::parse($data['income_date'])->format('Y-m-d');

            // Create income record
            $income = $this->incomeRepository->create([
                'user_id' => Auth::user()->id,
                'account_id' => $data['account_id'],
                'currency_id' => $data['currency_id'],
                'amount' => $data['amount'],
                'exchange_amount' => $exchangeAmount,
                'usd_amount' => $usdAmount,
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'note' => $data['note'],
                'reference' => $data['reference'],
                'income_date' => $incomeDate,
                'attachment' => $attachment
            ]);

            // Update the bank account balance
            $bankAccount->balance += $exchangeAmount;
            $bankAccount->usd_balance += $usdAmount;
            $bankAccount->save();

            DB::commit(); // Commit transaction if everything is successful

            return $income;

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs
            throw $e; // Re-throw the exception
        }
    }

    /**
     * Update an existing income record with transaction.
     */
    public function update(UpdateIncomeRequest $request, Income $income): Income
    {
        DB::beginTransaction(); // Start transaction

        try {
            $data = $request->validated();

            // Handle file upload if necessary
            $attachment = $this->handleAttachmentUpload($request, $income);

            // Convert the amounts
            $usdAmount = $this->currencyConversionService->convertToUsdAmount($request->currency_id, $request->amount);
            $bankAccount = BankAccount::find($request->account_id);
            $exchangeAmount = $this->currencyConversionService->convertToExchangeAmount($bankAccount->currency_id, $usdAmount);

            $incomeDate = Carbon::parse($data['income_date'])->format('Y-m-d');

            // Update income record
            $income->update([
                'user_id' => Auth::user()->id,
                'account_id' => $data['account_id'],
                'currency_id' => $data['currency_id'],
                'amount' => $data['amount'],
                'exchange_amount' => $exchangeAmount,
                'usd_amount' => $usdAmount,
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'note' => $data['note'],
                'reference' => $data['reference'],
                'income_date' => $incomeDate,
                'attachment' => $attachment
            ]);

            // Update the bank account balance
            $bankAccount->balance += $exchangeAmount;
            $bankAccount->usd_balance += $usdAmount;
            $bankAccount->save();

            DB::commit(); // Commit transaction if everything is successful

            return $income;

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs
            throw $e; // Re-throw the exception
        }
    }

    /**
     * Delete an income record with transaction.
     */
    public function delete(Income $income): void
    {
        DB::beginTransaction(); // Start transaction

        try {
            // Update the bank account balance before deleting the income
            $bankAccount = BankAccount::find($income->account_id);
            $bankAccount->balance -= $income->exchange_amount;
            $bankAccount->usd_balance -= $income->usd_amount;
            $bankAccount->save();

            // Delete income record
            $income->delete();

            DB::commit(); // Commit transaction if everything is successful

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction if an error occurs
            throw $e; // Re-throw the exception
        }
    }
}
