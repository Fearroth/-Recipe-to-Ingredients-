<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductRecipe;
use App\Models\Recipe;
use App\Models\ScrapedRecipe;
use App\Models\User;
use App\Models\WebScrapedUrl;

use Illuminate\Support\Facades\Hash;
use PHPHtmlParser\Dom;


use App\Consts\WebScrapingServiceKeys;


class WebScraperService
{

    //$sitemapUrl = 'https://kuchnialidla.pl/products_sitemap.xml';
    //$urls = getUrlsFromSitemap($sitemapUrl);
    public function getUrlsFromSitemap($sitemapUrl)
    {
        $sitemapContent = file_get_contents($sitemapUrl);
        $xml = simplexml_load_string($sitemapContent);
        $urls = [];

        foreach ($xml->url as $url) {
            $urls[] = (string) $url->loc;
        }

        return $urls;
    }

    public function saveUrlsToDatabase($urls)
    {
        foreach ($urls as $url) {
            WebScrapedUrl::firstOrCreate([
                WebScrapedUrl::URL => $url,
            ]);
        }
        return WebScrapingServiceKeys::MESSAGE_SCRAPING_SUCCESSFULL;
    }

    public function scrapeRecipeAndSave(WebScrapedUrl $webScrapedUrl)
    {
        $dom = new Dom;
        $dom->loadFromUrl($webScrapedUrl->{WebScrapedUrl::URL});

        //get title
        $title = $dom->find('.lead h1', 0)->text;


        //get ingredients
        $ingredients = [];
        $ingredientList = $dom->find('.skladniki li');
        foreach ($ingredientList as $ingredient) {
            $ingredients[] = $ingredient->text;
        }

        //get instructions
        $instructions = [];
        $instructionSections = $dom->find('#opis p');
        foreach ($instructionSections as $section) {
            $instructions[] = $section->text;
        }

        ScrapedRecipe::create([
            ScrapedRecipe::URL_ID => $webScrapedUrl->id,
            ScrapedRecipe::TITLE => $title,
            ScrapedRecipe::INGREDIENTS => json_encode($ingredients),
            ScrapedRecipe::INSTRUCTIONS => json_encode(($instructions)),
        ]);

        $webScrapedUrl->update([WebScrapedUrl::IS_SCRAPED => true]);
    }

    function parseScrapedRecipeToRecipe(ScrapedRecipe $scrapedRecipe)
    {
        //this as f.argument
        $user = User::firstOrCreate([
            User::NAME => 'kuchnialidla',
            User::EMAIL => 'kuchnialidla@example.com',
        ], [
                User::PASSWORD => Hash::make('q1w2e3r4t5')
            ]);
        ///======
        $instructions = json_decode(html_entity_decode($scrapedRecipe->instructions));
        $ingredients = json_decode(html_entity_decode($scrapedRecipe->ingredients));

        $recipe = Recipe::firstOrCreate(
            [Recipe::TITLE => html_entity_decode($scrapedRecipe->title)],
            [
                RECIPE::AUTHOR_ID => $user->id,
                RECIPE::INSTRUCTIONS => json_encode($instructions),
            ]
        );
        if ($recipe->wasRecentlyCreated) {
            foreach ($ingredients as $ingredient) {
                // Parse the ingredient string
                //'/(.*\S)\s*-\s*([\d.,]+)?\s*([\p{L}\s]*)/u'    
                //preg_match('/(.*):\s*([\d.,]+)?\s*(.*)/u',
                // preg_match('/(.*):\s*([\d.,]+)?\s*([^\d\s]*.*)/u'

                preg_match('/(.*?)(?:(?:\s*\-\s*)|(?:\s*\:\s*))\s*([\d.,]+)?\s*([\p{L}\s]*)/u', $ingredient, $matches);

                print_r([$ingredient, $matches]);

                $name = $matches[1];
                $quantity = $matches[2];
                $unit = $matches[3] ?? null;

                // Find or create the product
                $product = Product::firstOrCreate([Product::NAME => $name]);

                $recipe->products()->attach($product->id, [ProductRecipe::QUANTITY => $quantity, ProductRecipe::UNIT => $unit]);
            }
        }


        $scrapedRecipe->update(['is_parsed' => true]);
    }


}