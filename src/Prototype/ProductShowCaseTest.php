<?php

declare(strict_types=1);

namespace App\Prototype;

use Generator;
use PHPUnit\Framework\TestCase;

final class ProductShowCaseTest extends TestCase
{
    /** @dataProvider getOrderTestcases */
    public function testOrdersProductByPrice(array $products, array $expectedOrder)
    {
        $UUT = new ProductShowCase();
        $actualOrder = $UUT->orderProductList($products);

        $this->assertSame($expectedOrder, $actualOrder);
    }

    public function getOrderTestcases(): Generator
    {
        $product1 = new ProductDto();
        $product1->productId = 1;
        $product1->productTypeId = 1;
        $product1->name = 'GL 2020 90" chonker';
        $product1->description = 'Watch everything in perfect quality';
        $product1->shortName = 'Big TV';
        $product1->vendorId = 1;
        $product1->guaranteeMonths = 12;
        $product1->canBeInsured = true;
        $product1->color = 'Blue';
        $product1->priceExVat = 1;
        $product1->priceInclVat = 20;

        $product2 = clone $product1;
        $product2->productId = 2;
        $product2->priceInclVat = 25;

        $product3 = clone $product1;
        $product3->productId = 3;
        $product3->priceInclVat = 30;


        yield 'Order should not change' => [
            [$product1, $product2, $product3],
            [$product1, $product2, $product3],
        ];
        yield 'Should reverse order' => [
            [$product3, $product2, $product1],
            [$product1, $product2, $product3],
        ];
        yield 'Should switch 1st and 2nd product' => [
            [$product2, $product1, $product3],
            [$product1, $product2, $product3],
        ];
    }
}
