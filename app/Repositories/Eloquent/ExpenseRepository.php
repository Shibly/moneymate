<?php

namespace App\Repositories\Eloquent;

use App\Models\Expense;
use App\Repositories\Contracts\ExpenseInterface;
use Illuminate\Support\Collection;

class ExpenseRepository implements ExpenseInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Expense::where('user_id', auth()->id())->get();
    }

    /**
     * @param array $data
     * @return Expense
     */

    public function create(array $data): Expense
    {
        return Expense::create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Expense
     */
    public function update(array $data, int $id): Expense
    {
        $expense = Expense::find($id);
        $expense->update($data);
        return $expense;
    }

    /**
     * @param int $id
     * @return bool
     */

    public function delete(int $id): bool
    {
        $expense = Expense::find($id);
        $expense->delete();
        return true;
    }
}
