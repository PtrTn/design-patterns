<?php

declare(strict_types=1);

namespace App\FactoryMethod;

use InvalidArgumentException;

final class NumberFormatterFactory
{
    public const TYPE_FULL_NUMBER = 'FULL';
    public const TYPE_SHORTHAND_NUMBER = 'SHORTHAND';

    public function createFormatter(string $type): NumberFormatterInterface
    {
        return match ($type) {
            self::TYPE_FULL_NUMBER => new FullNumberFormatter(),
            self::TYPE_SHORTHAND_NUMBER => new ShorthandNumberFormatter(),
            default => throw new InvalidArgumentException(sprintf('Invalid number formatter type "%s"', $type)),
        };
    }
}
