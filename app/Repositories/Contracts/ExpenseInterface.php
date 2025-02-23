<?php

namespace App\Repositories\Contracts;

use App\Models\Expense;
use Illuminate\Support\Collection;

interface ExpenseInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return Collection
     */
    public function find(int $id): Collection;

    /**
     * @param array $data
     * @return Expense
     */
    public function create(array $data): Expense;

    /**
     * @param array $data
     * @param int $id
     * @return Expense
     */
    public function update(array $data, int $id): Expense;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

}
