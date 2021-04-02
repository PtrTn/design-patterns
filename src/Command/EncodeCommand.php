<?php

declare(strict_types=1);

namespace App\Command;

use App\AbstractFactory\EncoderFactory;
use App\AbstractFactory\EncodingType;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        if (!$helper instanceof QuestionHelper) {
            throw new RuntimeException('Unable to get console question helper');
        }

        $password = $helper->ask($input, $output, $this->getPasswordQuestion());
        $encodingType = $helper->ask($input, $output, $this->getEncodingQuestion());

        $encoder = EncoderFactory::getEncoderFactory($encodingType);
        $encodedPassword = $encoder->getEncoder()->encode($password);

        $output->writeln(sprintf('-- Encoding password with %s encoding --', $encodingType->toString()));
        $output->writeln($encodedPassword);
        $output->writeln('-- End of encoded password --');

        return Command::SUCCESS;
    }

    protected function getPasswordQuestion(): Question
    {
        $passwordQuestion = new Question('Please enter a password you\'d like to encode: ');
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);
        $passwordQuestion->setValidator(function ($answer) {
            if (!is_string($answer)) {
                throw new InvalidArgumentException('Password must be a string');
            }
            return $answer;
        });

        return $passwordQuestion;
    }

    protected function getEncodingQuestion(): ChoiceQuestion
    {
        $encodingQuestion = new ChoiceQuestion(
            'How would you like to encode the password?',
            EncodingType::all(),
            EncodingType::SHA256
        );
        $encodingQuestion->setValidator(function ($encoding) {
            return EncodingType::fromString($encoding);
        });

        return $encodingQuestion;
    }
}
