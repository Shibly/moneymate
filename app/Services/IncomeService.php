<?php

// app/Services/IncomeService.php

namespace App\Services;

use App\Http\Requests\UpdateIncomeRequest;
use App\Models\BankAccount;
use App\Models\Category;
use App\Models\Income;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function create($request)
    {
        $incomeData = $request->validated();
        $category = Category::findOrFail($request->category_id);

        // Handle file upload
        $incomeData['attachment'] = $this->handleAttachmentUpload($request);

        // Convert amount to USD
        $usdAmount = convert_to_usd_amount($request->currency_id, $request->amount);

        // Find the bank account
        $toBankAccount = BankAccount::find($request->account_id);
        $exchangeAmount = convert_to_exchange_amount($toBankAccount->currency_id, $usdAmount);

        // Format the income date
        $incomeDate = Carbon::parse($incomeData['income_date'])->format('Y-m-d');

        // Create the income record
        $income = Income::create([
            'user_id' => Auth::user()->id,
            'account_id' => $incomeData['account_id'],
            'currency_id' => $incomeData['currency_id'],
            'amount' => $incomeData['amount'],
            'exchange_amount' => $exchangeAmount,
            'usd_amount' => $usdAmount,
            'category_id' => $incomeData['category_id'],
            'description' => $incomeData['description'],
            'note' => $incomeData['note'],
            'reference' => $incomeData['reference'],
            'income_date' => $incomeDate,
            'attachment' => $incomeData['attachment']
        ]);

        // Update the bank account balance
        $toBankAccount->balance += $exchangeAmount;
        $toBankAccount->usd_balance += $usdAmount;
        $toBankAccount->save();

        return $income;
    }

    /**
     * Handle the attachment file upload.
     *
     * @param $request
     * @return string|null
     */
    private function handleAttachmentUpload($request): ?string
    {
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filename = time() . '.' . $attachment->getClientOriginalExtension();
            $attachment->storeAs('', $filename, 'local');
            return $filename;
        }
        return null;
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


    public function allIncomes()
    {
        return $this->incomeRepository->allIncomes();
    }

}
