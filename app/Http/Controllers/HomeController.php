<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Infographic;
use Illuminate\Http\Request;
use App\Services\CkanService;
use App\Services\SumselNewsService;

class HomeController extends Controller
{
    public function index(SumselNewsService $newsService, CkanService $ckan)
    {
        $banner = Banner::active()
            ->orderBy('id', 'DESC')
            ->get();
        $news = $newsService->getNews();
        $groups = $ckan->listGroups(true);
        $infographics = Infographic::orderBy('published_at', 'DESC')
            ->take(8)
            ->get();

        return view('home', compact('banner', 'news', 'groups', 'infographics'));
    }
}
