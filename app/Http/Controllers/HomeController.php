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
use App\Services\GeoportalService;

class HomeController extends Controller
{
    protected SumselNewsService $newsService;
    protected CkanService $ckan;
    protected GeoportalService $geoportal;

    public function __construct(SumselNewsService $newsService, CkanService $ckan, GeoportalService $geoportal)
    {
        $this->newsService = $newsService;
        $this->ckan = $ckan;
        $this->geoportal = $geoportal;
    }

    public function index()
    {
        $banner = Banner::active()
            ->orderBy('id', 'DESC')
            ->get();
        $news = $this->newsService->getNews();
        $groups = $this->ckan->listGroups(true);
        $records = $this->geoportal->getAll();
        $infographics = Infographic::orderBy('published_at', 'DESC')
            ->take(8)
            ->get();

        return view('home', compact('banner', 'news', 'groups', 'infographics', 'records'));
    }

    public function groups($groups)
    {

        $page = request()->get('page', 1);
        $perPage = 10;
        $keyword = request()->get('fq:groups', $groups);


        $data = $this->ckan->groupDatasets($page, $perPage, $groups);

        return view('dataset.datagroup', [
            'items' => $data['items'],
            'total' => $data['total'],

        ]);
    }
}
