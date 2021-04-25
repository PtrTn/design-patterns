<?php

declare(strict_types=1);

namespace App\Command;

use App\ObjectPool\PageTitleCrawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FetchWebsitesTitlesCommand extends Command
{
    protected static $defaultName = 'app:fetch:website-titles';

    private PageTitleCrawler $pageTitleCrawler;

    public function __construct(PageTitleCrawler $pageTitleCrawler)
    {
        parent::__construct();
        $this->pageTitleCrawler = $pageTitleCrawler;
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetches titles of multiple websites')
            ->setHelp('This command demos the use of the object pool design pattern')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('-- Starting to fetch page titles --');
        $urlsToVisit = [
            'https://www.php.net/',
            'https://www.sourcemaking.com/',
            'https://github.com/',
        ];
        foreach ($urlsToVisit as $url) {
            $title = $this->pageTitleCrawler->fetchPageTitle($url);
            $output->writeln(sprintf('Title for "%s" is "%s"', $url, $title));
        }
        $output->writeln('-- Done fetching page titles --');

        return Command::SUCCESS;
    }
}
