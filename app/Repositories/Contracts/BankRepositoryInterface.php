<?php

namespace App\Repositories\Contracts;

use App\Models\BankName;

interface BankRepositoryInterface
{
    /**
     * Create a new bank record.
     *
     * @param array $data
     * @return BankName
     */
    public function create(array $data): BankName;

    /**
     * Update an existing bank record.
     *
     * @param BankName $bankName
     * @param array $data
     * @return bool
     */
    public function update(BankName $bankName, array $data): bool;

    /**
     * Find a bank record by its primary key.
     *
     * @param int $id
     * @return BankName|null
     */
    public function find(int $id): ?BankName;
}
