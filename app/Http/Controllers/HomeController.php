<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Infographic;
use Illuminate\Http\Request;
use App\Services\CkanService;
use App\Services\SumselNewsService;
use App\Services\GeoportalService;

class HomeController extends Controller
{
    public function index(SumselNewsService $newsService, CkanService $ckan, GeoportalService $geoportal)
    {
        $banner = Banner::active()
            ->orderBy('id', 'DESC')
            ->get();
        $news = $newsService->getNews();
        $groups = $ckan->listGroups(true);
        $records = $geoportal->getAll();
        $infographics = Infographic::orderBy('published_at', 'DESC')
            ->take(8)
            ->get();

        return view('home', compact('banner', 'news', 'groups', 'infographics', 'records'));
    }
}
