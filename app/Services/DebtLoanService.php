<?php

namespace App\Services;

use App\Http\Requests\StoreDebtRequest;
use App\Models\BankAccount;
use App\Models\Debt;
use App\Repositories\Contracts\DebtLoanRepositoryInterface;
use Illuminate\Support\Collection;

class DebtLoanService
{
    private DebtLoanRepositoryInterface $debtLoanRepositoryInterface;

    public function __construct(DebtLoanRepositoryInterface $debtLoanRepositoryInterface)
    {
        $this->debtLoanRepositoryInterface = $debtLoanRepositoryInterface;
    }

    /**
     * @return Collection
     */

    public function getAll(): Collection
    {
        return $this->debtLoanRepositoryInterface->getAll();
    }

    /**
     * @param int $id
     * @return Debt
     */

    public function getById(int $id): Debt
    {
        return $this->debtLoanRepositoryInterface->getById($id);
    }

    /**
     * @param StoreDebtRequest $request
     * @return mixed
     */
    public function store($data): mixed
    {
        return $this->debtLoanRepositoryInterface->store($data);
    }

    public function storeDebtCollection(array $data, int $debt_id): mixed
    {
        return $this->debtLoanRepositoryInterface->storeDebtCollection($data, $debt_id);
    }

    public function destroy($id): bool
    {
        return $this->debtLoanRepositoryInterface->destroy($id);
    }

}
