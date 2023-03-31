<?php

namespace App\Console\Commands;

use App\Models\WebScrappedUrl;
use App\Services\WebScraperService;

use Illuminate\Console\Command;

class ScrapeRecipes extends Command
{
    protected $signature = 'scrape:recipes';
    protected $description = 'Scrape recipes from unprocessed URLs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $webScraperService = new WebScraperService();
        $urlsToScrape = WebScrappedUrl::where(WebScrappedUrl::IS_SCRAPED, false)->take(2)->get()->pluck('url');

        foreach ($urlsToScrape as $url) {
            $webScraperService->scrapeRecipeAndSave($url);
            echo 'procesing';
            sleep(5); // Wait for 5 seconds
        }
    }
}