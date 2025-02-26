<?php

namespace App\Repositories\Eloquent;

use App\Exports\ExpenseExport;
use App\Models\Expense;
use App\Repositories\Contracts\ExpenseReportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExpenseReportRepository implements ExpenseReportRepositoryInterface
{
    /**
     * Get incomes for a user within a specific date range.
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @param int $userId
     * @return Collection
     */
    public function getExpensesBetweenDates(?string $startDate, ?string $endDate, int $userId): Collection
    {

        if (empty($startDate)) {
            $startDate = Carbon::now()->subMonths(3)->toDateString();
        }

        if (empty($endDate)) {
            $endDate = Carbon::now()->toDateString();
        }

        return Expense::with('currency')->where('user_id', $userId)
            ->whereHas('category', fn($query) => $query->where('type', 'expense'))
            ->whereBetween('expense_date', [$startDate, $endDate])
            ->orderBy('expense_date', 'desc')
            ->get();
    }

    /**
     * Export the given incomes to Excel.
     *
     * @param Collection $expenses
     * @return BinaryFileResponse
     */
    public function exportToExcel(Collection $expenses): BinaryFileResponse
    {
        return Excel::download(new ExpenseExport($expenses), 'expense_report.xlsx');
    }
}
