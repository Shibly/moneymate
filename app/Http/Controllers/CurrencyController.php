<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Models\Currency;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    protected CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $currencies = Currency::with('bankAccounts')->select('id', 'name', 'exchange_rate', 'is_base', 'is_default')->get();
        $basedCurrencyName = Currency::where('is_base', 'yes')->first();
        $activeMenu = 'currencies';

        return view('admin.currencies.index', compact('currencies', 'basedCurrencyName', 'activeMenu'));
    }


    /**
     * @param StoreCurrencyRequest $request
     * @return mixed
     */

    public function store(StoreCurrencyRequest $request): mixed
    {
        $this->currencyService->create($request);
        notyf()->success('Currency has been added successfully.');
        return redirect()->route('currencies.index');
    }


    /**
     * @param UpdateCurrencyRequest $request
     * @param Currency $currency
     * @return mixed
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency): mixed
    {
        $updatedCurrency = $this->currencyService->update($request, $currency);
        notyf()->success('Currency has been updated successfully.');
        return redirect()->route('currencies.index');
    }

    public function destroy(Currency $currency): JsonResponse
    {
        $this->currencyService->delete($currency);
        return response()->json(['message' => 'Currency deleted']);
    }

    /**
     * @param int $currencyId
     * @return mixed
     */
    public function show(int $currencyId): mixed
    {
        $currency = $this->currencyService->findById($currencyId);
        return response()->json($currency, 200);
    }

}
