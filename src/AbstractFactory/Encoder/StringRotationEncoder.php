<?php

declare(strict_types=1);

namespace App\AbstractFactory\Encoder;

final class StringRotationEncoder implements Encoder
{
    public function encode(string $password): string
    {
        return str_rot13($password);
    }
}
