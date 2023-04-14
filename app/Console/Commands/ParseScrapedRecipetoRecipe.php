<?php

namespace App\Console\Commands;

use App\Models\ScrapedRecipe;
use App\Services\WebScraperService;

use Illuminate\Console\Command;

class parseScrapedRecipeToRecipe extends Command
{
    protected $signature = "parse:recipes";
    protected $description = 'parse recipe from scraped recipes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $webScraperService = new WebScraperService();

        $scrapedRecipes = ScrapedRecipe::where(ScrapedRecipe::IS_PARSED, false)->take(10)->get();

        foreach ($scrapedRecipes as $scrapedRecipe) {
            $webScraperService->parseScrapedRecipeToRecipe($scrapedRecipe);
            echo 'procesing';
            sleep(5); // Wait for 5 seconds
        }
    }
}