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
            $url = 'https://sumselprov.go.id/api/sumselprov/berita/' . $request->slug;
            $response = file_get_contents($url, false, stream_context_create($arrContextOptions));
            $resData = json_decode($response);

            if ($resData) {
                // Support both wrapped in 'data' and raw object formats
                if (isset($resData->data) && is_object($resData->data)) {
                    $dberita = $resData->data;
                } else {
                    $dberita = $resData;
                }

                if (isset($dberita->judul) && isset($dberita->slug)) {
                    // Prepare $gambar as an array of full URLs
                    // $gambar = [];
                    // if (!empty($dberita->gambar_url)) {
                    //   $gambar = explode(',', $dberita->gambar);

                    //} elseif (!empty($dberita->gambar)) {
                    //  $relativeImages = explode(',', $dberita->gambar);

                    foreach ($relativeImages as $img) {
                        $gambar[] = 'https://sumselprov.go.id/' . ltrim($img, '/');
                    }
                    //  }

                    return view('news.detail', compact('dberita', 'gambar'));
                }
            }

            return abort(404);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
