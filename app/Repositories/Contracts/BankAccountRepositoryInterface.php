<?php

namespace App\Repositories\Contracts;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Collection;

interface BankAccountRepositoryInterface
{
    public function create(array $data): BankAccount;

    public function update(BankAccount $bankAccount, array $data): BankAccount;

    public function delete(BankAccount $bankAccount): void;

    public function findById(int $id): ?BankAccount;

    public function findByUserId(int $userId): Collection;

    public function findByBankNameId(int $bankNameId): Collection;
}
