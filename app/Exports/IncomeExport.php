<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IncomeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @var Collection
     */
    protected $incomes;

    /**
     * IncomeExport constructor.
     *
     * @param Collection $incomes
     */
    public function __construct(Collection $incomes)
    {
        $this->incomes = $incomes;
    }

    /**
     * Return a collection of incomes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        return $this->incomes;
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
     * @param mixed $income
     * @return array
     */
    public function map($income): array
    {
        $exchangeCurrency = optional($income->bankAccount->currency)->name;

        return [
            $income->id,
            $income->user_id,
            $income->account_id,
            optional($income->category)->name,
            optional($income->currency)->name,
            $exchangeCurrency,
            number_format($income->amount, 2),
            number_format($income->exchange_amount, 2),
            $income->reference,
            $income->income_date,
            $income->description,
            $income->note,
            $income->attachment,
            $income->created_at,
            $income->updated_at,
        ];
    }
}
