<?php

namespace App\Repositories\Eloquent;

use App\Models\Income;
use App\Repositories\Contracts\IncomeRepositoryInterface;

class IncomeRepository implements IncomeRepositoryInterface
{
    public function create(array $data): Income
    {
        return Income::create($data);
    }

    public function update(Income $income, array $data): Income
    {
        $income->update($data);
        return $income;
    }

    public function findById(int $id): ?Income
    {
        return Income::find($id);
    }

    public function delete(Income $income): void
    {
        $income->delete();
    }
}
