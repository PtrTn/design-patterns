<?php

declare(strict_types=1);

namespace App\ObjectPool;

final class PageTitleCrawler
{
    private BrowserPagePool $browserPagePool;

    public function __construct(BrowserPagePool $browserPagePool)
    {
        $this->browserPagePool = $browserPagePool;
    }

    public function fetchPageTitle(string $url): string
    {
        $page = $this->browserPagePool->acquireBrowserPage();

        $page->navigate($url)->waitForNavigation();

        $pageTitle = $page->evaluate('document.title')->getReturnValue();

        $this->browserPagePool->releaseBrowserPage($page);

        return $pageTitle;
    }
}
