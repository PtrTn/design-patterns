<?php

declare(strict_types=1);

namespace App\AbstractFactory\Factory;

use App\AbstractFactory\Encoder\Encoder;
use App\AbstractFactory\Encoder\HashEncoder;
use App\AbstractFactory\EncoderFactory;

final class Md5EncoderFactory extends EncoderFactory
{
    public function getEncoder(): Encoder
    {
        return new HashEncoder('md5');
    }
}
