<?php

declare(strict_types=1);

namespace App\Prototype;

use Generator;
use PHPUnit\Framework\TestCase;

final class OrderStateTest extends TestCase
{
    /** @dataProvider getStateTestCases */
    public function testShouldGuardState(OrderState $state, string $expectedState): void
    {
        $this->assertSame($expectedState, $state->getState());
    }

    public function getStateTestCases(): Generator
    {
        $placed = OrderState::place();

        $picked = clone $placed;
        $picked->pick();

        $packed = clone $picked;
        $packed->pack();

        $sent = clone $packed;
        $sent->send();

        $delivered = clone $sent;
        $delivered->deliver();

        yield 'placed' => [$placed, 'PLACED'];
        yield 'picked' => [$picked, 'PICKED'];
        yield 'packed' => [$packed, 'PACKED'];
        yield 'sent' => [$sent, 'SENT'];
        yield 'delivered' => [$delivered, 'DELIVERED'];
    }
}
