<?php

use App\Http\Controllers\DatasetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographicsController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\InstantionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TentangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('dataset')->group(function () {
    Route::get('/', [DatasetController::class, 'index'])->name('dataset.index');
    Route::get('/{id}', [DatasetController::class, 'show'])->name('dataset.show');
});
Route::prefix('instansi')->group(function () {
    Route::get('/', [InstantionController::class, 'index'])->name('instantion.index');
    Route::get('/{id}', [InstantionController::class, 'show'])->name('instantion.show');
});

Route::get('/data-insight', [InsightController::class, 'index'])->name('insights.index');
Route::prefix('publikasi')->group(function () {
    Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
    Route::get('/berita/{slug}', [NewsController::class, 'detail_news'])->name('detail.news');
    Route::get('/infografis', [InfographicsController::class, 'index'])->name('infographics.index');
});

Route::prefix('tentang')->group(function () {
    Route::get('/profil', [TentangController::class, 'profil'])->name('tentang.profil');
    Route::get('/struktur', [TentangController::class, 'struktur'])->name('tentang.struktur');
});
