<?php

declare(strict_types=1);

namespace App\Prototype;

final class ProductDto
{
    public int $productId;
    public int $productTypeId;
    public string $name;
    public string $description;
    public string $shortName;
    public int $vendorId;
    public int $guaranteeMonths;
    public bool $canBeInsured;
    public string $color;
    public float $priceExVat;
    public float $priceInclVat;
}
