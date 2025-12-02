<?php

namespace App\Http\Controllers;

use App\Services\CkanService;
use Illuminate\Http\Request;

class InstantionController extends Controller
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
        $keyword = request()->get('q');

        $data = $this->ckan->paginatedOrganizations($page, $perPage, $keyword);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $data['items'],
            $data['total'],
            $perPage,
            $page,
            [
                'path' => url('instansi'),
                'query' => ['q' => $keyword]
            ]
        );

        return view('instantion.index', [
            'instantions' => $paginator,
            'keyword' => $keyword
        ]);
    }

    public function show($id)
    {
        $instantion = $this->ckan->getOrganization($id);

        if (!$instantion) {
            abort(404);
        }

        // Hitung jumlah dataset
        $datasetCount = $this->ckan->countOrganizationDatasets($id);

        // Jika user klik "lihat semua"
        $showAll = request()->get('show', 0);

        // Dataset paginate
        $datasets = null;

        if ($showAll) {
            $page = request()->get('page', 1);
            $perPage = 10;

            $data = $this->ckan->paginatedOrganizationDatasets($id, $page, $perPage);

            $datasets = new \Illuminate\Pagination\LengthAwarePaginator(
                $data['items'],
                $data['total'],
                $perPage,
                $page,
                ['path' => url()->current()]
            );
        }

        return view('instantion.show', compact('instantion', 'datasetCount', 'datasets', 'showAll'));
    }
}
