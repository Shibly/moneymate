<?php

namespace App\Repositories\Contracts;

use App\Models\Budget;
use Illuminate\Support\Collection;

interface BudgetInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $data
     * @return Collection
     */
    public function store(array $data): Collection;

    /**
     * @param int $id
     * @return Budget|null
     */

    public function findById(int $id): ?Budget;

    /**
     * @param $id
     * @param array $data
     * @return Collection
     */
    public function update($id, array $data): Collection;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

}
