<?php

declare(strict_types=1);

namespace App\Adapter;

final class CurrencyService
{
    private const EURO_TO_DOLLAR_CONVERSION_RATE = 1.21;

    public function convertEuroToDollar(float $euro): float
    {
        return round($euro * self::EURO_TO_DOLLAR_CONVERSION_RATE, 2);
    }
}
