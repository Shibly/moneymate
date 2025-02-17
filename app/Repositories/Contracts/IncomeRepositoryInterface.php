<?php

// app/Repositories/Contracts/IncomeRepositoryInterface.php

namespace App\Repositories\Contracts;

use App\Models\Income;

interface IncomeRepositoryInterface
{

    public function allIncomes();
    public function create(array $data): Income;

    public function update(Income $income, array $data): Income;

    public function findById(int $id): ?Income;

    public function delete(Income $income): void;
}
