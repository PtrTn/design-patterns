<?php

declare(strict_types=1);

namespace App\Prototype;

final class ProductShowCase
{
    /** @param ProductDto[] $products */
    public function orderProductList(array $products)
    {
        usort(
            $products,
            fn(ProductDto $productA, ProductDto $productB) => $productA->priceInclVat <=> $productB->priceInclVat
        );

        return $products;
    }
}
