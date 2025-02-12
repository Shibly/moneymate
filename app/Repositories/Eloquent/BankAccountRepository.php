<?php


namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount
    {
        return BankAccount::create($data);
    }

    public function update(BankAccount $bankAccount, array $data): BankAccount
    {
        $bankAccount->update($data);
        return $bankAccount;
    }

    public function delete(BankAccount $bankAccount): void
    {
        $bankAccount->delete();
    }

    public function findById(int $id): ?BankAccount
    {
        return BankAccount::find($id);
    }

    public function findByUserId(int $userId): Collection
    {
        return BankAccount::where('user_id', $userId)->get();
    }

    public function findByBankNameId(int $bankNameId): Collection
    {
        return BankAccount::where('bank_name_id', $bankNameId)->get();
    }

}
