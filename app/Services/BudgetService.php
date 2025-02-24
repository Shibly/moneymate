<?php

namespace App\Services;

use App\Models\Budget;
use App\Repositories\Contracts\BudgetInterface;
use Illuminate\Support\Collection;

class BudgetService
{
    /**
     * @var BudgetInterface
     */
    protected BudgetInterface $budgetInterface;

    /**
     * @param BudgetInterface $budgetInterface
     */
    public function __construct(BudgetInterface $budgetInterface)
    {
        $this->budgetInterface = $budgetInterface;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
      return $this->budgetInterface->all();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function store(array $data): Collection
    {
        return $this->budgetInterface->store($data);
    }

    /**
     * @param int $id
     * @return Budget
     */

    public function findById(int $id): Budget
    {
        return $this->budgetInterface->findById($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Collection
     */

    public function update(int $id, array $data): Collection
    {
        return $this->budgetInterface->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     */

    public function delete(int $id): void
    {
         $this->budgetInterface->delete($id);
    }

}
