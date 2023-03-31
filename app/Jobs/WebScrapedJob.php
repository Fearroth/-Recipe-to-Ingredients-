<?php
namespace App\Jobs;

use App\Services\WebScraperService;
use App\Consts\WebScrapingServiceKeys;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WebScrapedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $webScraper = new WebScraperService();

        // Download and parse the sitemap
        $sitemapUrl = WebScrapingServiceKeys::SITE_MAP_URL;
        $urls = $webScraper->getUrlsFromSitemap($sitemapUrl);

        $webScraper->saveUrlsToDatabase($urls);
    }
}