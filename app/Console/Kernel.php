<?php

namespace App\Console;

use App\Jobs\WebScrapedJob;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Consts\WebScrapingServiceKeys;
use App\Services\WebScraperService;

use App\Console\Commands\ScrapeRecipes;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //XML to table AS JOB
        $schedule->job(new WebScrapedJob())->daily(); 

        // XML to table AS FUNCTION
        // $schedule->call(function () {
        //     $webScraper = new WebScraperService();

        //     // Download and parse the sitemap
        //     $sitemapUrl = WebScrapingServiceKeys::SITE_MAP_URL;
        //     $urls = $webScraper->getUrlsFromSitemap($sitemapUrl);
        //     $webScraper->saveUrlsToDatabase($urls);
        // })->everyMinute();

        //Site scraping from KuchnieLidla
        $schedule->command(ScrapeRecipes::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}