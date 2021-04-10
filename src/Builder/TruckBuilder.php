<?php

declare(strict_types=1);

namespace App\Builder;

final class TruckBuilder implements Builder
{
    private Truck $truck;

    public function reset(): void
    {
        $this->truck = new Truck();
    }

    public function setWheels(int $wheels): void
    {
        $this->truck->setWheels($wheels);
    }

    public function setWeight(int $weight): void
    {
        $this->truck->setWeight($weight);
    }

    public function setTrailerWheels(int $wheels): void
    {
        $this->truck->setTrailerWheels($wheels);
    }

    public function setTrailerWeight(int $weight): void
    {
        $this->truck->setTrailerWeight($weight);
    }

    public function getTruck(): Truck
    {
        return $this->truck;
    }
}
