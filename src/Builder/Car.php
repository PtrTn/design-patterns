<?php

declare(strict_types=1);

namespace App\Builder;

final class Car
{
    private int $wheels;
    private int $weight;
    private int $trailerWheels;
    private int $trailerWeight;

    public function setWheels(int $wheels)
    {
        $this->wheels = $wheels;
    }

    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    public function setTrailerWheels(int $wheels)
    {
        $this->trailerWheels = $wheels;
    }

    public function setTrailerWeight(int $weight)
    {
        $this->trailerWeight = $weight;
    }
}
