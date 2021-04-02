<?php

declare(strict_types=1);

namespace App\AbstractFactory;

use App\AbstractFactory\Encoder\Encoder;
use App\AbstractFactory\Factory\Md5EncoderFactory;
use App\AbstractFactory\Factory\Sha256EncoderFactory;
use App\AbstractFactory\Factory\StringRotationEncoderFactory;
use InvalidArgumentException;

abstract class EncoderFactory
{
    abstract public function getEncoder(): Encoder;

    public static function getEncoderFactory(EncodingType $encodingType): self
    {
        return match ($encodingType->toString()) {
            EncodingType::ROT13 => new StringRotationEncoderFactory(),
            EncodingType::SHA256 => new Sha256EncoderFactory(),
            EncodingType::MD5 => new Md5EncoderFactory(),
            default => throw new InvalidArgumentException(
                sprintf('Unsupported encoding type "%s"', $encodingType->toString())
            ),
        };
    }
}
