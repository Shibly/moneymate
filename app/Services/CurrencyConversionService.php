<?php

// app/Services/CurrencyConversionService.php

namespace App\Services;

use App\Models\Currency;

class CurrencyConversionService
{
    /**
     * Convert the given amount to USD based on the currency_id.
     *
     * @param int $currencyId
     * @param float $amount
     * @return float
     */
    public function convertToUsdAmount(int $currencyId, float $amount): float
    {
        // Retrieve the currency from the database
        $currency = Currency::find($currencyId);

        if ($currency) {
            // If currency has a non-zero exchange rate, use it to convert
            return $amount * $currency->exchange_rate;
        }

        // Default to 1 if currency is not found
        return $amount;
    }

    /**
     * Convert the given amount to the target currency based on the exchange rate.
     *
     * @param int $currencyId
     * @param float $amount
     * @return float
     */
    public function convertToExchangeAmount(int $currencyId, float $amount): float
    {
        // Retrieve the target currency from the database
        $currency = Currency::find($currencyId);

        if ($currency) {
            // Use exchange rate to convert the amount to the target currency
            return $amount * $currency->exchange_rate;
        }

        // Default to 1 if currency is not found
        return $amount;
    }
}
