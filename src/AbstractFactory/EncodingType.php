<?php

declare(strict_types=1);

namespace App\AbstractFactory;

use Webmozart\Assert\Assert;

final class EncodingType
{
    public const MD5 = 'MD5';
    public const SHA256 = 'SHA256';
    public const ROT13 = 'ROT13';

    private string $encodingType;

    private function __construct(string $encodingType)
    {
        Assert::oneOf($encodingType, [self::MD5, self::SHA256, self::ROT13]);

        $this->encodingType = $encodingType;
    }

    public static function fromString(string $encodingType)
    {
        return new self($encodingType);
    }

    public function toString(): string
    {
        return $this->encodingType;
    }
}
