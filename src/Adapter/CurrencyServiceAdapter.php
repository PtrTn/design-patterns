<?php

declare(strict_types=1);

namespace App\Adapter;

final class CurrencyServiceAdapter
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService  $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function convertEuroToDollar(Money $euro): Money
    {
        $dollar = $this->currencyService->convertEuroToDollar($euro->getAmount());

        return new Money($dollar, Money::CURRENCY_DOLLAR);
    }
}
