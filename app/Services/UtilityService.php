<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;

class UtilityService
{
    public function parseImgLinks($url)
    {
        $data = Http::get($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($data->body());
        $xpath = new DOMXPath($dom);
        $imgElements = $xpath->query('//img[@class="promo-tile__picture"]');
        $links = [];
        for($i = 0; $i < 8; $i++){
            $links[] = $imgElements[$i]->getAttribute('src');
        }

        return $links;
    }
}
