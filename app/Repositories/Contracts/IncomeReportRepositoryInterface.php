<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface IncomeReportRepositoryInterface
{
    /**
     * Get incomes for a user within a specific date range.
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int $userId
     * @return Collection
     */
    public function getIncomesBetweenDates(?string $startDate, ?string $endDate, int $userId, ?array $selectedCategories): Collection;

    /**
     * Export incomes (already filtered) to Excel.
     *
     * @param Collection $incomes
     * @return BinaryFileResponse
     */
    public function exportToExcel(Collection $incomes);
}
