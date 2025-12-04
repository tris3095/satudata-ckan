<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $berita = null;

        try {
            $arrContextOptions = [
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ];

            $url = "https://sumselprov.go.id/api/sumselprov/api_berita_all2?page={$page}";
            $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
            $berita = json_decode($response);
        } catch (\Throwable $th) {
            $berita = null;
        }

        $items = collect($berita->data ?? []);

        $paginator = new LengthAwarePaginator(
            $items,
            $berita->total ?? 0,
            $berita->per_page ?? 10,
            $berita->current_page ?? 1,
            ['path' => url()->current()]
        );

        return view('news.index', compact('paginator'));
    }

    public function detail_news(Request $request)
    {
        try {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $dberita = json_decode(file_get_contents('https://sumselprov.go.id/api/sumselprov/beritadetailslug?judul=' . $request->slug, true, stream_context_create($arrContextOptions)));
            $gambar = preg_split('/[,]/', $dberita->gambar, -1, PREG_SPLIT_NO_EMPTY);
            return view('news.detail', compact('dberita', 'gambar'));
        } catch (\Throwable $th) {
            $dberita['data'] = "";
            $gambar = "";
            return abort(404);
        }
        return abort(404);
    }
}
