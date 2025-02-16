<?php


namespace App\Services;

use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyService
{
    protected CurrencyRepositoryInterface $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }


    public function getAll(){
        return $this->currencyRepository->getAll();
    }

    public function create(StoreCurrencyRequest $request): Currency
    {
        // Handle is_default logic
        if ($request->has('is_default') && $request->is_default == 'yes') {
            $this->currencyRepository->unsetDefaultCurrency();
        }

        if (Currency::count() > 0) {
            $currencyData = $this->prepareCurrencyData($request);
        } else {
            $currencyData = $this->prepareCurrencyData($request, 'yes');
        }

        return $this->currencyRepository->create($currencyData);
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency): Currency
    {
        // Handle is_default logic
        if ($request->has('is_default') && $request->is_default == 'yes') {
            $this->currencyRepository->unsetDefaultCurrency();
        }

        $currencyData = $this->prepareCurrencyData($request);
        $currency->update($currencyData);

        // Ensure that there is always a default currency
        if ($this->currencyRepository->countDefaultCurrency() == 0) {
            $this->currencyRepository->setFirstDefaultCurrency();
        }

        return $currency;
    }

    public function delete(Currency $currency): bool
    {
        return $this->currencyRepository->delete($currency);
    }

    public function findById(int $id): ?Currency
    {
        return $this->currencyRepository->findById($id);
    }

    private function prepareCurrencyData($request, $default = 'no'): array
    {
        return [
            'name' => $request->name,
            'exchange_rate' => $request->exchange_rate ?? 0,
            'is_default' => $request->is_default ?? $default,
        ];
    }
}
