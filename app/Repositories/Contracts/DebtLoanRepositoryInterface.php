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

    /**
     * @param array $data
     * @param int $debt_id
     * @return mixed
     */
    public function storeDebtCollection(array $data, int $debt_id): mixed;

    /**
     * @param array $data
     * @param int $debt_id
     * @return mixed
     */
    public function storeRepayment(array $data, int $debt_id): mixed;

    /**
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool;

}
