<?php

namespace App\Services;

use App\Consts\WebScrapingServiceKeys;
use App\Models\WebScrappedUrl;

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
            WebScrappedUrl::firstOrCreate([
                WebScrappedUrl::URL => $url,
            ]);
        }
        return WebScrapingServiceKeys::MESSAGE_SCRAPPING_SUCCESSFULL;
    }




    public function scrapeRecipe($url)
    {
        // Your logic for scraping the recipe data from the given URL
    }
}