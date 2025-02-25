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
            'ID',
            'User ID',
            'Account ID',
            'Category',
            'Original Currency',
            'Exchange Currency',
            'Amount',
            'Exchange Amount',
            'Reference',
            'Income Date',
            'Description',
            'Note',
            'Attachment',
            'Created At',
            'Updated At',
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
            $expense->id,
            $expense->user_id,
            $expense->account_id,
            optional($expense->category)->name,
            optional($expense->currency)->name,
            $exchangeCurrency,
            number_format($expense->amount, 2),
            number_format($expense->exchange_amount, 2),
            $expense->reference,
            $expense->income_date,
            $expense->description,
            $expense->note,
            $expense->attachment,
            $expense->created_at,
            $expense->updated_at,
        ];
    }
}
