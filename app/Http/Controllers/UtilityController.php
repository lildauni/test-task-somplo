<?php

namespace App\Http\Controllers;

use App\Services\UtilityService;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;

class UtilityController extends Controller
{
    protected $utilityService;
    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }
    public function parser(Request $request)
    {
        $links = $this->utilityService->parseImgLinks('https://rozetka.com.ua/ua/news-articles-promotions/promotions/');
        return response()->json($links);
    }
}
