<?php

namespace App\Http\Controllers;

use App\Models\ProdukStatistik;
use App\Models\StatisticNews;
use Illuminate\Http\Request;

class ProdukStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = ProdukStatistik::where('is_active', 1)->orderBy('published_at', 'DESC')
            ->paginate(12);

        return view('prs.index', compact('publications'))->with('title', 'Berita Resmi Statistik');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {


        $dberita = ProdukStatistik::where('id', $id)->first();

        return view('prs.detail', compact('dberita'));
    }
    public function show(StatisticNews $statisticNews) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatisticNews $statisticNews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatisticNews $statisticNews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatisticNews $statisticNews)
    {
        //
    }
}
