<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Infographic;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount   = User::count();
        $bannerCount = Banner::count();
        $infographicCount   = Infographic::count();

        return view('admin.pages.dashboard', compact(
            'userCount',
            'bannerCount',
            'infographicCount',
        ))->with('title', 'Dasbor');
    }
}
