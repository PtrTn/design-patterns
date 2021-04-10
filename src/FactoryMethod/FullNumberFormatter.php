<?php

declare(strict_types=1);

namespace App\FactoryMethod;

final class FullNumberFormatter implements NumberFormatterInterface
{
    public function format(float $number): string
    {
        return (string) round($number);
    }
}
