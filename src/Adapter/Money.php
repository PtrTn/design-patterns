<?php

declare(strict_types=1);

namespace App\Adapter;

use Webmozart\Assert\Assert;

final class Money
{
    public const CURRENCY_EURO = 'euro';
    public const CURRENCY_DOLLAR = 'dollar';

    private float $amount;
    private string $currency;

    public function __construct(float $amount, string $currency)
    {
        Assert::oneOf($currency, [self::CURRENCY_DOLLAR, self::CURRENCY_EURO]);

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
