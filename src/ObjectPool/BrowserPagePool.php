<?php

declare(strict_types=1);

namespace App\ObjectPool;

use HeadlessChromium\Browser;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;

final class BrowserPagePool
{
    private BrowserFactory $browserFactory;

    /** @var Page[] */
    private array $pagePool = [];

    private ?Browser $browser = null;

    public function __construct(string $chromePath)
    {
        $this->browserFactory = new BrowserFactory($chromePath);
    }

    public function acquireBrowserPage(): Page
    {
        if (count($this->pagePool) === 0) {
            $browser = $this->createBrowser();
            var_dump('Creating page');

            return $browser->createPage();
        }

        var_dump('Reusing page');
        return array_shift($this->pagePool);
    }

    public function releaseBrowserPage(Page $page): void
    {
        $this->pagePool[] = $page;
    }

    private function createBrowser(): Browser
    {
        if ($this->browser === null) {
            var_dump('Creating browser');
            $this->browser = $this->browserFactory->createBrowser(['headless' => false, 'sendSyncDefaultTimeout' => 10000]);
        }

        return $this->browser;
    }
}
