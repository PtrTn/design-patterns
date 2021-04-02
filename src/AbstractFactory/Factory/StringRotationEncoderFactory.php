<?php

declare(strict_types=1);

namespace App\AbstractFactory\Factory;

use App\AbstractFactory\Encoder\Encoder;
use App\AbstractFactory\Encoder\StringRotationEncoder;
use App\AbstractFactory\EncoderFactory;

final class StringRotationEncoderFactory extends EncoderFactory
{
    public function getEncoder(): Encoder
    {
        return new StringRotationEncoder();
    }
}
