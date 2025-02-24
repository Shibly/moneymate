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
     * @return mixed
     */
    public function store(array $data): mixed;


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

}
