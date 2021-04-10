<?php

declare(strict_types=1);

namespace App\Builder;

final class CarBuilder implements Builder
{
    private Car $car;

    public function reset(): void
    {
        $this->car = new Car();
    }

    public function setWheels(int $wheels): void
    {
        $this->car->setWheels($wheels);
    }

    public function setWeight(int $weight): void
    {
        $this->car->setWeight($weight);
    }

    public function setTrailerWheels(int $wheels): void
    {
        $this->car->setTrailerWheels($wheels);
    }

    public function setTrailerWeight(int $weight): void
    {
        $this->car->setTrailerWeight($weight);
    }

    public function getCar(): Car
    {
        return $this->car;
    }
}
