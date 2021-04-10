<?php

declare(strict_types=1);

namespace App\Command;

use App\FactoryMethod\NumberFormatterFactory;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

final class FormatNumberCommand extends Command
{
    protected static $defaultName = 'app:format:number';

    private NumberFormatterFactory $numberFormatterFactory;

    public function __construct(NumberFormatterFactory $numberFormatterFactory)
    {
        parent::__construct();
        $this->numberFormatterFactory = $numberFormatterFactory;
    }

    protected function configure()
    {
        $this
            ->setDescription('Formats a number')
            ->setHelp('This command demos the use of the factory method design pattern')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        if (!$helper instanceof QuestionHelper) {
            throw new RuntimeException('Unable to get console question helper');
        }

        $number = $helper->ask($input, $output, $this->getNumberQuestion());
        $format = $helper->ask($input, $output, $this->getFormatQuestion());

        $formatter = $this->numberFormatterFactory->createFormatter($format);
        $formattedNumber = $formatter->format($number);

        $output->writeln(sprintf('-- Formatting number with %s format --', $format));
        $output->writeln($formattedNumber);
        $output->writeln('-- End of formatted number --');

        return Command::SUCCESS;
    }

    protected function getNumberQuestion(): Question
    {
        $numberQuestion = new Question('Please enter a number you\'d like to format: ');
        $numberQuestion->setValidator(function ($answer) {
            if (!is_numeric($answer)) {
                throw new InvalidArgumentException('Please enter a valid number');
            }
            return (float) $answer;
        });

        return $numberQuestion;
    }

    protected function getFormatQuestion(): ChoiceQuestion
    {
        return new ChoiceQuestion(
            'How would you like to format the number?',
            [NumberFormatterFactory::TYPE_SHORTHAND_NUMBER, NumberFormatterFactory::TYPE_FULL_NUMBER]
        );
    }
}
