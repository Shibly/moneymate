<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAll()
    {
        return Currency::select('id', 'name')->get();
    }

    public function create(array $data): Currency
    {
        // If 'is_default' is 'yes', set other currencies to 'no'
        if (isset($data['is_default']) && $data['is_default'] === 'yes') {
            $this->unsetDefaultCurrency(); // Ensure only one currency has 'is_default' set to 'yes'
        }

        return Currency::create($data);
    }

    public function update(Currency $currency, array $data): bool
    {
        // If 'is_default' is being set to 'yes', unset other currencies
        if (isset($data['is_default']) && $data['is_default'] === 'yes') {
            $this->unsetDefaultCurrency(); // Ensure only one currency has 'is_default' set to 'yes'
        }

        return $currency->update($data);
    }

    public function delete(Currency $currency): bool
    {
        return $currency->delete();
    }

    public function findById(int $id): ?Currency
    {
        return Currency::find($id);
    }

    public function unsetDefaultCurrency(): void
    {

        Currency::where('is_default', 'yes')->update([
            'is_default' => 'no',
            'exchange_rate' => 0,
        ]);
    }

    public function setFirstDefaultCurrency(): void
    {
        $firstCurrency = Currency::orderBy('id', 'asc')->first();
        if ($firstCurrency) {
            $firstCurrency->update(['is_default' => 'yes']);
        }


        $this->unsetDefaultCurrency();
    }

    public function countDefaultCurrency(): int
    {
        return Currency::where('is_default', 'yes')->count();
    }
}
