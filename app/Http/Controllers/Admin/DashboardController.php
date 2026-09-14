<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Infographic;
use App\Models\User;
use App\Services\CkanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __construct(protected CkanService $ckan)
    {
    }

    public function index()
    {
        $userCount   = User::count();
        $bannerCount = Banner::count();
        $infographicCount   = Infographic::count();

        // CKAN stats need several remote calls (facets + monthly breakdown),
        // so cache them briefly instead of hitting the portal on every load.
        $datasetStats = Cache::remember('admin.dashboard.dataset_stats', now()->addMinutes(15), function () {
            return $this->ckan->dashboardDatasetStats();
        });

        return view('admin.pages.dashboard', compact(
            'userCount',
            'bannerCount',
            'infographicCount',
            'datasetStats',
        ))->with('title', 'Dasbor');
    }

    public function webmin()
    {
        $userCount   = User::count();
        $bannerCount = Banner::count();
        $infographicCount   = Infographic::count();

        return view('admin.pages.monitor', compact(
            'userCount',
            'bannerCount',
            'infographicCount',
        ))->with('title', 'Webmin');
    }
}
