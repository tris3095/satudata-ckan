<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Infographic;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Services\CkanService;
use App\Services\SumselNewsService;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected SumselNewsService $newsService;
    protected CkanService $ckan;

    public function __construct(SumselNewsService $newsService, CkanService $ckan)
    {
        $this->newsService = $newsService;
        $this->ckan = $ckan;
    }

    public function index()
    {
        $banner = Banner::active()
            ->orderBy('id', 'DESC')
            ->get();
        $news = $this->newsService->getNews();
        $groups = $this->ckan->listGroups(true);
        $infographics = Infographic::orderBy('published_at', 'DESC')
            ->take(8)
            ->get();

        return view('home', compact('banner', 'news', 'groups', 'infographics'));
    }
}
