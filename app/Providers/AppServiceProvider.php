<?php

namespace App\Providers;

use App\Models\Visitor;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $today = Carbon::today();

        View::share([
            'totalVisitors'   => Visitor::count(),
            'todayVisitors'   => Visitor::whereDate('visited_at', $today)->count(),
            'monthlyVisitors' => Visitor::whereMonth('visited_at', $today->month)
                ->whereYear('visited_at', $today->year)->count(),
            'yearlyVisitors'  => Visitor::whereYear('visited_at', $today->year)->count(),
        ]);
    }
}
