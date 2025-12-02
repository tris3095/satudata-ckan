<?php

use App\Http\Controllers\DatasetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\InstantionController;
use App\Http\Controllers\NewsController;
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
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'detail_news'])->name('detail.news');
