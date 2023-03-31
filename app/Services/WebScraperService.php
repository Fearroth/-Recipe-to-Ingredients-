<?php

namespace App\Services;

use App\Consts\WebScrapingServiceKeys;
use App\Models\ScrapedRecipe;
use App\Models\WebScrapedUrl;

use PHPHtmlParser\Dom;


class WebScraperService
{

    //$sitemapUrl = 'https://kuchnialidla.pl/products_sitemap.xml';
    //$urls = getUrlsFromSitemap($sitemapUrl);
    function getUrlsFromSitemap($sitemapUrl)
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




    public function scrapeRecipeAndSave($url)
    {
        $dom = new Dom;
        $dom->loadFromUrl($url);
        //get title
        $title = $dom->find('.lead h1', 0)->text;
        $ingredientList = $dom->find('.skladniki li');
        //get ingredients
        $ingredients = [];
        foreach ($ingredientList as $ingredient) {
            $ingredients[] = $ingredient->text;
        }
        //get instructions
        $instructions = [];
        $instructionSections = $dom->find('#opis p');
        foreach ($instructionSections as $section) {
            $instructions[] = $section->text;
        }

        $urlModel = WebScrapedUrl::where('url', $url)->first();
        ScrapedRecipe::create([
            ScrapedRecipe::URL_ID => $urlModel->id,
            ScrapedRecipe::TITLE => $title,
            ScrapedRecipe::INGREDIENTS => json_encode($ingredients),
            ScrapedRecipe::INSTRUCTIONS => json_encode($instructions),
        ]);
        $urlModel->update(['is_scraped' => true]);
    }


}