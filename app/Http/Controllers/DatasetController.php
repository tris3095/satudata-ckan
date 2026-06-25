<?php

namespace App\Http\Controllers;

use App\Services\CkanService;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    protected $ckan;

    public function __construct(CkanService $ckan)
    {
        $this->ckan = $ckan;
    }

    public function index()
    {
        $page = request()->get('page', 1);
        $perPage = 10;
        $keyword = request()->get('q', null);

        $data = $this->ckan->paginatedDatasets($page, $perPage, $keyword);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data['items'],
            $data['total'],
            $perPage,
            $page,
            [
                'path' => url('dataset'),
                'query' => ['q' => $keyword]
            ]
        );

        return view('dataset.index', [
            'datasets' => $paginator,
            'keyword' => $keyword
        ]);
    }


    public function show($id)
    {
        $dataset = $this->ckan->getDataset($id);

        if (!$dataset) {
            abort(404);
        }

        return view('dataset.show', compact('dataset'));
    }

    public function download(Request $request, \App\Services\DataMaskingService $maskingService)
    {
        $url = $request->query('url');
        if (empty($url)) {
            abort(400, 'Missing url parameter');
        }

        $fileData = $maskingService->maskFileFromUrl($url);

        // Fallback to raw stream if masking service encountered an error
        if (isset($fileData['error']) && $fileData['error']) {
            return response()->streamDownload(function () use ($url) {
                // Ignore SSL verification issues if any
                $context = stream_context_create([
                    "ssl" => [
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ],
                ]);
                echo file_get_contents($url, false, $context);
            }, basename($url));
        }

        $filename = basename(parse_url($url, PHP_URL_PATH) ?: 'download');

        return response()->streamDownload(function () use ($fileData) {
            echo $fileData['content'];
        }, $filename, [
            'Content-Type' => $fileData['mime'],
        ]);
    }
}

