<?php

use App\Http\Controllers\WebinarController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographicsController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\InstantionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticNewsController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\ProdukStatistikController;
use App\Http\Middleware\CountVisitorByIP;
use Illuminate\Support\Facades\Route;

Route::middleware([CountVisitorByIP::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/data/geospasial', [HomeController::class, 'geospatial'])->name('geospatial.index');

    Route::get('/groups', [HomeController::class, 'groupsList'])->name('groups.list');
    Route::get('/groups/{groups}', [HomeController::class, 'groups'])->name('group.show');

    Route::prefix('dataset')->group(function () {
        Route::get('/', [DatasetController::class, 'index'])->name('dataset.index');
        Route::get('/{id}', [DatasetController::class, 'show'])->name('dataset.show');
    });
    Route::prefix('instansi')->group(function () {
        Route::get('/', [InstantionController::class, 'index'])->name('instantion.index');
        Route::get('/{id}', [InstantionController::class, 'show'])->name('instantion.show');
    });

    Route::prefix('metadata')->group(function () {
        //  Route::get('/', [HomeController::class, 'metadata'])->name('metadata.show');
        Route::get('/{id}', [HomeController::class, 'metadata'])->name('metadata.show');
        Route::get('/{jenis}/{id}', [HomeController::class, 'vdetailmetadata'])->name('metadata.detail');
    });
    Route::get('/data-insight', [InsightController::class, 'index'])->name('insights.index');
    Route::prefix('publikasi')->group(function () {
        Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
        Route::get('/berita/{slug}', [NewsController::class, 'detail_news'])->name('detail.news');
        Route::get('/infografis', [InfographicsController::class, 'index'])->name('infographics.index');
        Route::get('/brs', [StatisticNewsController::class, 'index'])->name('brs.index');
        Route::get('/prs', [ProdukStatistikController::class, 'index'])->name('prs.index');
        Route::get('/prs/{id}', [ProdukStatistikController::class, 'detail'])->name('detail.prs');
        Route::get('/brs/{slug}', [StatisticNewsController::class, 'detail'])->name('detail.brs');
        Route::get('/webinar', [WebinarController::class, 'index'])->name('webinar.index');
        Route::get('/dokumen-esakip', [HomeController::class, 'esakipDocuments'])->name('esakip.documents');
    });
    Route::get('/ckan-download', [DatasetController::class, 'download'])->name('dataset.download');
    Route::prefix('survei')->group(function () {
        Route::get('/', [SurveiController::class, 'index'])->name('survei.index');
        Route::post('/', [SurveiController::class, 'store'])->name('survei.store');
    });
    Route::prefix('tentang')->group(function () {
        Route::get('/profil', [TentangController::class, 'profil'])->name('tentang.profil');
        Route::get('/struktur', [TentangController::class, 'struktur'])->name('tentang.struktur');
    });
    Route::view('/regulasi/dtsen', 'regulasi.dtsen')->name('regulasi.dtsen');
    Route::view('/regulasi/geospasial', 'regulasi.geospasial')->name('regulasi.geospasial');
    Route::view('/regulasi/e-walidata-kemendagri', 'regulasi.e-walidata-kemendagri')
        ->name('regulasi.e-walidata-kemendagri');
    Route::view('/regulasi/satu-data-indonesia', 'regulasi.satu-data-indonesia')
        ->name('regulasi.satu-data-indonesia');
    Route::view('/regulasi/interoperabilitas', 'regulasi.interoperabilitas')
        ->name('regulasi.interoperabilitas');
    Route::view('/regulasi/metadata-statistik', 'regulasi.metadata-statistik')
        ->name('regulasi.metadata-statistik');
    Route::view('/regulasi/standar-data-statistik', 'regulasi.standar-data-statistik')
        ->name('regulasi.standar-data-statistik');
});
