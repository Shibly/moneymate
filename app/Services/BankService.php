<?php

namespace App\Services;

use App\Models\BankName;
use App\Repositories\Contracts\BankRepositoryInterface;

class BankService
{
    protected BankRepositoryInterface $bankRepository;

    /**
     * BankService constructor.
     */
    public function __construct(BankRepositoryInterface $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    /**
     * Create a new bank record.
     */
    public function createBank(array $data): BankName
    {
        return $this->bankRepository->create($data);
    }

    /**
     * Update an existing bank record.
     */
    public function updateBank(BankName $bankName, array $data): bool
    {
        return $this->bankRepository->update($bankName, $data);
    }

    /**
     * Retrieve a single bank record by ID.
     */
    public function getBankById(int $id): ?BankName
    {
        return $this->bankRepository->find($id);
    }
}
