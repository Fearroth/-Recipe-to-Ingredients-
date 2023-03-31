<?php

namespace App\Console\Commands;

use App\Consts\ScrapeRecipesKeys;
use App\Models\WebScrapedUrl;
use App\Services\WebScraperService;

use Illuminate\Console\Command;

class ScrapeRecipes extends Command
{
    protected $signature = ScrapeRecipesKeys::SIGNATURE;
    protected $description = ScrapeRecipesKeys::PROGRESS_MESSAGE;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $webScraperService = new WebScraperService();
        $urlsToScrape = WebScrapedUrl::where(WebScrapedUrl::IS_SCRAPED, false)->take(2)->get()->pluck(WebScrapedUrl::URL);

        foreach ($urlsToScrape as $url) {
            $webScraperService->scrapeRecipeAndSave($url);
            echo ScrapeRecipesKeys::PROGRESS_MESSAGE;
            sleep(5); // Wait for 5 seconds
        }
    }
}