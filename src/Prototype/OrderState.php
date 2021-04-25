<?php

declare(strict_types=1);

namespace App\Prototype;

use RuntimeException;

final class OrderState
{
    public const STATE_PLACED = 'PLACED';
    public const STATE_PICKED = 'PICKED';
    public const STATE_PACKED = 'PACKED';
    public const STATE_SENT = 'SENT';
    public const STATE_DELIVERED = 'DELIVERED';

    private string $state;

    private function __construct()
    {
        $this->state = self::STATE_PLACED;
    }

    public static function place(): self
    {
        return new self();
    }

    public function pick(): void
    {
        if ($this->state !== self::STATE_PLACED) {
            throw new RuntimeException('Unable to transition');
        }
        $this->state = self::STATE_PICKED;
    }

    public function pack(): void
    {
        if ($this->state !== self::STATE_PICKED) {
            throw new RuntimeException('Unable to transition');
        }
        $this->state = self::STATE_PACKED;
    }

    public function send(): void
    {
        if ($this->state !== self::STATE_PACKED) {
            throw new RuntimeException('Unable to transition');
        }
        $this->state = self::STATE_SENT;
    }

    public function deliver(): void
    {
        if ($this->state !== self::STATE_SENT) {
            throw new RuntimeException('Unable to transition');
        }
        $this->state = self::STATE_DELIVERED;
    }

    public function getState(): string
    {
        return $this->state;
    }
}
