<?php

declare(strict_types=1);

namespace App\Builder;

interface Builder
{
    public function reset(): void;
    public function setWheels(int $wheels): void;
    public function setWeight(int $weight): void;
    public function setTrailerWheels(int $wheels): void;
    public function setTrailerWeight(int $weight): void;
}
