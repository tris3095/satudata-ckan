<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthenticatorController;
use App\Http\Controllers\Admin\InfographicController;
use App\Http\Controllers\Admin\StatisticNewsController;
use App\Http\Controllers\Admin\WebinarController;

use App\Http\Controllers\Admin\ProdukStatistikController;
use App\Http\Controllers\Admin\SurveiJawabanController;
use App\Http\Controllers\Admin\SurveiPertanyaanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\PreventBackMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::middleware(PreventBackHistory::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->prefix('auth')->group(function () {
        Route::get('login', [AuthenticatorController::class, 'index'])->name('login');
        Route::post('login', [AuthenticatorController::class, 'store']);
    });
    Route::middleware(PreventBackMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/banner', BannerController::class);
        Route::resource('/infographic', InfographicController::class);
        Route::resource('/webinar', WebinarController::class);
        Route::resource('/brs', StatisticNewsController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/produk', ProdukStatistikController::class);
        Route::get('/survei-pertanyaan', [SurveiPertanyaanController::class, 'index'])->name('survei-pertanyaan.index');
        Route::get('/survei-jawaban', [SurveiJawabanController::class, 'index'])->name('survei-jawaban.index');
        Route::get('/profile', [AuthenticatorController::class, 'editProfile'])->name('profile');
        Route::patch('/profile', [AuthenticatorController::class, 'updateProfile'])->name('profile.update');
        Route::post('logout', [AuthenticatorController::class, 'logout'])->name('logout');
    });
});
