<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CkanService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('ckan.url'), '/');
        $this->apiKey = config('ckan.api_key');
    }

    public function listDatasets()
    {
        $response = Http::get($this->baseUrl . '/api/3/action/package_list');
        return $response->json()['result'] ?? [];
    }

    public function getDataset($id)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/package_show', [
            'id' => $id
        ]);

        return $response->json()['result'] ?? null;
    }

    public function search($keyword)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'q' => $keyword
        ]);

        return $response->json()['result'] ?? [];
    }

    public function listDatasetDetail()
    {
        $slugs = $this->listDatasets();
        $result = [];

        foreach ($slugs as $slug) {
            $detail = $this->getDataset($slug);
            if ($detail) {
                $result[] = [
                    'slug' => $slug,
                    'title' => $detail['title'] ?? $slug,
                    'notes' => $detail['notes'] ?? '',
                ];
            }
        }

        return $result;
    }

    public function paginatedDatasets($page = 1, $perPage = 10, $keyword = null)
    {
        $start = ($page - 1) * $perPage;

        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'rows' => $perPage,
            'start' => $start,
            'q' => $keyword
        ])->json();

        $result = $response['result'] ?? [];

        return [
            'items' => $result['results'] ?? [],
            'total' => $result['count'] ?? 0,
        ];
    }

    public function listOrganizations()
    {
        $response = Http::get($this->baseUrl . '/api/3/action/organization_list', [
            'all_fields' => true
        ]);

        return $response->json()['result'] ?? [];
    }

    public function getOrganization($id)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/organization_show', [
            'id' => $id
        ]);

        return $response->json()['result'] ?? null;
    }

    public function getOrganizationDatasets($orgName)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => 100 // ambil banyak dataset
        ])->json();

        return $response['result']['results'] ?? [];
    }

    public function countOrganizationDatasets($orgName)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => 0
        ])->json();

        return $response['result']['count'] ?? 0;
    }


    public function paginatedOrganizationDatasets($orgName, $page = 1, $perPage = 10)
    {
        $start = ($page - 1) * $perPage;

        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => $perPage,
            'start' => $start
        ])->json();

        return [
            'items' => $response['result']['results'] ?? [],
            'total' => $response['result']['count'] ?? 0
        ];
    }


    public function paginatedOrganizations($page = 1, $perPage = 10, $keyword = null)
    {
        // Ambil seluruh organisasi terlebih dahulu
        $response = Http::get($this->baseUrl . '/api/3/action/organization_list', [
            'all_fields' => true
        ]);

        $all = $response->json()['result'] ?? [];

        // Filter by keyword (name/title)
        if ($keyword) {
            $all = array_filter($all, function ($org) use ($keyword) {
                return stripos($org['title'], $keyword) !== false ||
                    stripos($org['name'], $keyword) !== false;
            });
        }

        $total = count($all);

        // Pagination manual
        $offset = ($page - 1) * $perPage;
        $items = array_slice($all, $offset, $perPage);

        return [
            'items' => $items,
            'total' => $total
        ];
    }

    public function listGroups($allFields = true)
    {
        try {
            $response = Http::timeout(10) // batas waktu request
                ->get($this->baseUrl . '/api/3/action/group_list', [
                    'all_fields' => $allFields
                ]);

            // cek apakah response sukses
            if ($response->successful()) {
                return $response->json()['result'] ?? [];
            }

            // jika server balas error (500, 404, dll)
            return [
                'error' => true,
                'message' => 'Server merespon dengan status: ' . $response->status()
            ];
        } catch (\Exception $e) {
            // jika server mati / tidak bisa diakses
            return [
                'error' => true,
                'message' => 'Server tidak dapat diakses: ' . $e->getMessage()
            ];
        }
    }

    public function getGroup($id)
    {
        $response = Http::get($this->baseUrl . '/api/3/action/group_show', [
            'id' => $id
        ]);

        return $response->json()['result'] ?? null;
    }

    public function groupDatasets($page = 1, $perPage = 10, $keyword = null)
    {

        $start = ($page - 1) * $perPage;
        $response = Http::get($this->baseUrl . '/api/3/action/package_search', [
            'fq' => "groups:$keyword",
            'start' => $start,
            'rows' =>  100,
        ]);

        $datasets = collect($response['result']['results']);

        return [
            'items' => $datasets,
            'total' => $response['result']['count'] ?? 0,
        ];
    }
}
