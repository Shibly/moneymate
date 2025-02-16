<?php

use App\Models\Currency;


if (!function_exists('get_option')) {
    function get_option($key)
    {
        $system_settings = config('options');
        if ($key && isset($system_settings[$key])) {
            return $system_settings[$key];
        } else {
            return false;
        }
    }
}


if (!function_exists('convert_to_usd_amount')) {
    function convert_to_usd_amount($selectedCurrency, $amount)
    {
        $currency = Currency::find($selectedCurrency);
        if ($currency->is_based == 'yes') {
            return $amount;
        } else {
            if ($currency->exchange_rate > 0) {
                return $amount / $currency->exchange_rate;
            } else {
                return $amount;
            }

        }
    }
}


if (!function_exists('convert_to_exchange_amount')) {
    function convert_to_exchange_amount($currencyId, $usdAmount)
    {
        $currency = Currency::find($currencyId);
        if ($currency->is_based == 'yes') {
            return $usdAmount;
        } else {
            return $usdAmount * $currency->exchange_rate;
        }
    }
}
