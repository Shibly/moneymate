<?php

namespace App\Repositories\Contracts;

use App\Models\Debt;
use Ramsey\Collection\Collection;

interface DebtLoanRepositoryInterface
{
    public function getAll();

    /**
     * @param int $id
     * @return Debt
     */
    public function getById(int $id): Debt;

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed;
    public function storeDebtCollection(array $data, int $debt_id): mixed;

    public function destroy(int $id): bool;

}
