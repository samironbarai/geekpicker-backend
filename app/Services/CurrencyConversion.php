<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConversion
{
    /**
     * Getting currency rate by currency name
     * Rate is based on EUR currency
     * @param $currency
     * @return string
     */
    public function getRate($currency)
    {
        $response = Http::get("http://data.fixer.io/api/latest?access_key=" . config('services.fixer.key') . "&format=1");

        // If response is false, we will send rate = 0, and create a log
        // We will make advanced validate latter
        if (!$response['success']) {
            info('Error on fixer api . ' . $response);
            return 0;
        }

        // If no error, then return real conversion rate
        return $response['rates'][$currency];
    }
}
