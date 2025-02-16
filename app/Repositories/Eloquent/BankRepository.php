<?php

namespace App\Repositories\Eloquent;

use App\Models\BankName;
use App\Repositories\Contracts\BankRepositoryInterface;

class BankRepository implements BankRepositoryInterface
{
    /**
     * Create a new bank record.
     */
    public function create(array $data): BankName
    {
        return BankName::create($data);
    }

    /**
     * Update an existing bank record.
     */
    public function update(BankName $bankName, array $data): bool
    {
        return $bankName->update($data);
    }

    /**
     * Find a bank record by its primary key.
     */
    public function find(int $id): ?BankName
    {
        return BankName::find($id);
    }

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return BankName::select('id', 'user_id', 'bank_name')->get();

    }
}
