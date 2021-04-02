<?php

declare(strict_types=1);

namespace App\Command;

use App\AbstractFactory\EncoderFactory;
use App\AbstractFactory\EncodingType;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class EncodeCommand extends Command
{
    protected static $defaultName = 'app:encode:password';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Encodes a password')
            ->setHelp('This command demos the use of the abstract factory design pattern')
            ->addArgument('password', InputArgument::REQUIRED, 'Please enter a password you\'d like to encode')
            ->addArgument('encoding', InputArgument::OPTIONAL, 'How would you like to encode the password?', 'SHA256')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $encoding = $input->getArgument('encoding');
        if (!is_string($encoding)) {
            throw new InvalidArgumentException('Encoding must be a string');
        }
        $encodingType = EncodingType::fromString($encoding);

        $password = $input->getArgument('password');
        if (!is_string($password)) {
            throw new InvalidArgumentException('Password must be a string');
        }

        $encoder = EncoderFactory::getEncoderFactory($encodingType);
        $encodedPassword = $encoder->getEncoder()->encode($password);

        $output->writeln(sprintf('-- Encoding password with %s encoding --', $encodingType->toString()));
        $output->writeln($encodedPassword);
        $output->writeln('-- End of encoded password --');

        return Command::SUCCESS;
    }
}
