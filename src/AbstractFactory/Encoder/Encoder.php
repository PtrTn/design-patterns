<?php

declare(strict_types=1);

namespace App\AbstractFactory\Encoder;

interface Encoder
{
    public function encode(string $password): string;
}
