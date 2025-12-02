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
}
