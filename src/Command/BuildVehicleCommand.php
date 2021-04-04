<?php

declare(strict_types=1);

namespace App\Command;

use App\Builder\Car;
use App\Builder\CarBuilder;
use App\Builder\Truck;
use App\Builder\TruckBuilder;
use App\Builder\Director;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class BuildVehicleCommand extends Command
{
    protected static $defaultName = 'app:build:vehicle';

    private Director $director;
    private CarBuilder $carBuilder;
    private TruckBuilder $truckBuilder;

    public function __construct(Director $director, CarBuilder $carBuilder, TruckBuilder $truckBuilder)
    {
        parent::__construct();

        $this->director = $director;
        $this->carBuilder = $carBuilder;
        $this->truckBuilder = $truckBuilder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Builds a vehicle based on input json')
            ->setHelp('This command demos the use of the builder design pattern')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = json_decode(file_get_contents(__DIR__ . '/../Builder/example.json'), true);

        foreach ($data as $vehicle) {
            var_dump($this->buildVehicle($vehicle));
        }

        return Command::SUCCESS;
    }

    private function buildVehicle(array $vehicle): Truck|Car
    {
        if ($vehicle['type'] === 'Car' && $vehicle['trailer'] === null) {
            $this->director->withoutTrailer(
                $this->carBuilder,
                $vehicle['wheels'],
                $vehicle['weight']
            );
            return $this->carBuilder->getCar();
        }

        if ($vehicle['type'] === 'Car' && $vehicle['trailer'] !== null) {
            $this->director->withTrailer(
                $this->carBuilder,
                $vehicle['wheels'],
                $vehicle['weight'],
                $vehicle['trailer']['wheels'],
                $vehicle['trailer']['weight']
            );
            return $this->carBuilder->getCar();
        }

        if ($vehicle['type'] === 'Truck' && $vehicle['trailer'] === null) {
            $this->director->withoutTrailer(
                $this->truckBuilder,
                $vehicle['wheels'],
                $vehicle['weight']
            );
            return $this->truckBuilder->getTruck();
        }

        if ($vehicle['type'] === 'Truck' && $vehicle['trailer'] !== null) {
            $this->director->withTrailer(
                $this->truckBuilder,
                $vehicle['wheels'],
                $vehicle['weight'],
                $vehicle['trailer']['wheels'],
                $vehicle['trailer']['weight']
            );
            return $this->truckBuilder->getTruck();
        }

        throw new InvalidArgumentException(sprintf('Unsupported vehicle type "%s"', $vehicle['type']));
    }
}
