<?php

declare(strict_types=1);

namespace App\Builder;

final class Director
{
    public function withoutTrailer(Builder $builder, int $wheels, int $weight)
    {
        $builder->reset();
        $builder->setWheels($wheels);
        $builder->setWeight($weight);
    }

    public function withTrailer(Builder $builder, int $wheels, int $weight, int $trailerWheels, int $trailerWeight)
    {
        $builder->reset();
        $builder->setWheels($wheels);
        $builder->setWeight($weight);
        $builder->setTrailerWheels($trailerWheels);
        $builder->setTrailerWeight($trailerWeight);
    }
}
