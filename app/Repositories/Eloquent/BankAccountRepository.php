<?php


namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BankAccountRepository implements BankAccountRepositoryInterface
{

    public function getAll()
    {
        return BankAccount::select('id', 'account_name', 'account_number', 'balance')->get();
    }

    public function create(array $data): BankAccount
    {
        $data['usd_balance'] = convert_to_usd_amount($data['currency_id'], $data['balance']);
        $data['user_id'] = auth()->user()->id;
        return BankAccount::create($data);
    }


    public function update($bankAccountId, array $data): BankAccount
    {

        $bankAccount = BankAccount::find($bankAccountId);
        if (isset($data['currency_id']) && isset($data['balance'])) {
            $data['usd_balance'] = convert_to_usd_amount($data['currency_id'], $data['balance']);
        }

        $data['user_id'] = $bankAccount->user_id ?? auth()->user()->id;
        $bankAccount->update($data);

        return $bankAccount;
    }


    public function delete($bankAccountId): void
    {
        $bankAccount = BankAccount::find($bankAccountId);
        $bankAccount->delete();
    }

    public function findById(int $id): ?BankAccount
    {
        return BankAccount::find($id);
    }

    public function findByUserId(int $userId): Collection
    {
        return BankAccount::with('bank')
            ->where('user_id', $userId)
            ->get();


    }


    public function findByBankNameId(int $bankNameId): Collection
    {
        return BankAccount::where('bank_name_id', $bankNameId)->get();
    }

    public function lockForUpdate(int $accountId): BankAccount
    {
        return BankAccount::where('id', $accountId)->lockForUpdate()->first();
    }
}
