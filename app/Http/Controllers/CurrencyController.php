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

    public function index(): JsonResponse
    {
        $currencies = Currency::with('bankAccounts')->select('id', 'name', 'exchange_rate', 'is_base', 'is_default')->get();
        $basedCurrencyName = Currency::where('is_base', 'yes')->first()->name;
        return response()->json([
            'data' => CurrencyResource::collection($currencies),
            'based_currency_name' => $basedCurrencyName
        ]);
    }

    public function store(StoreCurrencyRequest $request): JsonResponse
    {
        $currency = $this->currencyService->create($request);
        return response()->json([
            'currency' => $currency
        ]);
    }

    public function update(UpdateCurrencyRequest $request, Currency $currency): JsonResponse
    {
        $updatedCurrency = $this->currencyService->update($request, $currency);
        return response()->json([
            'currency' => $updatedCurrency
        ]);
    }

    public function destroy(Currency $currency): JsonResponse
    {
        $this->currencyService->delete($currency);
        return response()->json(['message' => 'Currency deleted']);
    }
}
