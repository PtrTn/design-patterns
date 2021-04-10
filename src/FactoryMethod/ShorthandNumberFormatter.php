<?php

declare(strict_types=1);

namespace App\FactoryMethod;

final class ShorthandNumberFormatter implements NumberFormatterInterface
{
    private const MILLION = self::THOUSAND * self::THOUSAND;
    private const THOUSAND = 1000;

    public function format(float $number): string
    {
        if ($number >= self::MILLION) {
            $millions = $number / self::MILLION;

            return round($millions, 1) . 'M';
        }
        if ($number >= self::THOUSAND) {
            $thousands = $number / self::THOUSAND;

            return round($thousands, 1) . 'K';
        }

        return (string) $number;
    }
}
