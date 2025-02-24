<?php

use App\Models\Currency;
use App\Models\Language;
use App\Models\Translation;


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


// app/Helpers/helpers.php

if (!function_exists('get_translation')) {
    /**
     * Get translation value based on key. Automatically uses the default language code.
     * Falls back to English ('en') if no translation is found for the default code.
     *
     * @param string $key
     * @return string|null
     */
    function get_translation($key): ?string
    {

        $defaultCode = Language::where('is_default', '1')->value('code');


        if (!$defaultCode) {
            $defaultCode = 'en';
        }

        $translation = Translation::where('key', $key)
            ->where('code', strtolower($defaultCode)) // Ensure the code is lowercase
            ->value('value');


        if (!$translation) {
            $translation = Translation::where('key', $key)
                ->where('code', 'en')
                ->value('value');
        }

        return $translation;
    }


}

