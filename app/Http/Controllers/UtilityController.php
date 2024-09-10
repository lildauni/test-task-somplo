<?php

namespace App\Http\Controllers;

use App\Services\UtilityService;
use Goutte\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;

class UtilityController extends Controller
{
    public function __construct(private UtilityService $utilityService) {}
    public function parser(Request $request) : JsonResponse
    {
        $links = $this->utilityService->getImgLinks('https://rozetka.com.ua/ua/news-articles-promotions/promotions/');
        return response()->json(['links' => $links]);
    }
}
