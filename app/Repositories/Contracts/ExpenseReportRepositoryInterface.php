<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface ExpenseReportRepositoryInterface
{


    public function getExpensesBetweenDates(?string $startDate, ?string $endDate, int $userId):Collection;

    /**
     * Export incomes (already filtered) to Excel.
     *
     * @param Collection $expenses
     * @return BinaryFileResponse
     */
    public function exportToExcel(Collection $expenses);

}
