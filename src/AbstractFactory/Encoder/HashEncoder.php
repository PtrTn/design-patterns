<?php

declare(strict_types=1);

namespace App\AbstractFactory\Encoder;

final class HashEncoder implements Encoder
{
    private string $hash;

    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    public function encode(string $password): string
    {
        return hash($this->hash, $password, false);
    }
}
