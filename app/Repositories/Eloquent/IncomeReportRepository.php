<?php

namespace App\Repositories\Eloquent;

use App\Exports\IncomeExport;
use App\Models\Income;
use App\Repositories\Contracts\IncomeReportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IncomeReportRepository implements IncomeReportRepositoryInterface
{
    /**
     * Get incomes for a user within a specific date range.
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int $userId
     * @return Collection
     */
    public function getIncomesBetweenDates(?string $startDate, ?string $endDate, int $userId): Collection
    {
        // Default date range (last 3 months)
        if (empty($startDate)) {
            $startDate = Carbon::now()->subMonths(3)->toDateString();
        }

        if (empty($endDate)) {
            $endDate = Carbon::now()->toDateString();
        }

        return Income::with('currency')->where('user_id', $userId)
            ->whereHas('category', fn($query) => $query->where('type', 'income'))
            ->whereBetween('income_date', [$startDate, $endDate])
            ->orderBy('income_date', 'desc')
            ->get();
    }

    /**
     * Export the given incomes to Excel.
     *
     * @param Collection $incomes
     * @return BinaryFileResponse
     */
    public function exportToExcel(Collection $incomes)
    {
        return Excel::download(new IncomeExport($incomes), 'income_report.xlsx');
    }
}
