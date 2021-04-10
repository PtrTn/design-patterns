<?php

declare(strict_types=1);

namespace App\FactoryMethod;

interface NumberFormatterInterface
{
    public function format(float $number): string;
}
