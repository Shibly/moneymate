<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpenseExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @var Collection
     */
    protected Collection $expense;

    /**
     * IncomeExport constructor.
     *
     * @param Collection $expense
     */
    public function __construct(Collection $expense)
    {
        $this->expense = $expense;
    }

    /**
     * Return a collection of incomes.
     *
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->expense;
    }

    /**
     * Define the headings for each column in the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Account Number',
            'Category',
            'Amount',
            'Expense Date',
            'Reference',
            'Description',
        ];
    }

    /**
     * Map data for each row in the Excel sheet.
     *
     * @param mixed $expense
     * @return array
     */
    public function map($expense): array
    {
        $exchangeCurrency = optional($expense->bankAccount->currency)->name;

        return [
            $expense->bankAccount->account_number,
            $expense->category->name,
            number_format($expense->amount, 2) . ' ' . $exchangeCurrency,
            $expense->expense_date,
            $expense->reference,
            $expense->description,
        ];
    }
}
