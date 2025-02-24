<?php

namespace App\Repositories\Eloquent;

use App\Models\Budget;
use Illuminate\Support\Collection;

class BudgetRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Budget::where('user_id', auth()->id())->get();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function store(array $data): Collection
    {
        return Budget::create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Collection
     */
    public function update(int $id, array $data): Collection
    {
        $budget = Budget::findOrFail($id);
        $budget->update($data);
        return $budget;
    }

    /**
     * @param int $id
     * @return Budget
     */

    public function findById(int $id): Budget
    {
       return Budget::findOrFail($id);
    }

    /**
     * @param int $id
     * @return void
     */

    public function delete(int $id): void
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();
    }
}
