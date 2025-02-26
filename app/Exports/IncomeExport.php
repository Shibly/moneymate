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
    protected Collection $incomes;

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
     * @return Collection
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
            'Account Number',
            'Category',
            'Amount',
            'Income Date',
            'Reference',
            'Description',
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
            $income->bankAccount->account_number,
            $income->category->name,
            number_format($income->amount, 2) . ' ' . $exchangeCurrency,
            $income->income_date,
            $income->reference,
            $income->description,

        ];
    }
}
