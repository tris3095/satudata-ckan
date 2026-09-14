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
        $response = Http::get($this->baseUrl.'/api/3/action/package_list');

        return $response->json()['result'] ?? [];
    }

    public function getDataset($id)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/package_show', [
            'id' => $id,
        ]);

        return $response->json()['result'] ?? null;
    }

    public function search($keyword)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'q' => $keyword,
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

        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'rows' => $perPage,
            'start' => $start,
            'q' => $keyword,
        ])->json();

        $result = $response['result'] ?? [];

        return [
            'items' => $result['results'] ?? [],
            'total' => $result['count'] ?? 0,
        ];
    }

    public function listOrganizations()
    {
        $organizations = [];
        $offset = 0;
        $limit = 25;

        do {
            $response = Http::get($this->baseUrl.'/api/3/action/organization_list', [
                'all_fields' => true,
                'limit' => $limit,
                'offset' => $offset,
            ]);

            if (! $response->successful()) {
                break;
            }

            $batch = $response->json('result', []);

            if (! is_array($batch)) {
                break;
            }

            $organizations = array_merge($organizations, $batch);
            $offset += count($batch);
        } while (count($batch) === $limit);

        return $organizations;
    }

    public function getOrganization($id)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/organization_show', [
            'id' => $id,
        ]);

        return $response->json()['result'] ?? null;
    }

    public function getOrganizationDatasets($orgName)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => 100, // ambil banyak dataset
        ])->json();

        return $response['result']['results'] ?? [];
    }

    public function countOrganizationDatasets($orgName)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => 0,
        ])->json();

        return $response['result']['count'] ?? 0;
    }

    public function paginatedOrganizationDatasets($orgName, $page = 1, $perPage = 10)
    {
        $start = ($page - 1) * $perPage;

        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'fq' => "organization:$orgName",
            'rows' => $perPage,
            'start' => $start,
        ])->json();

        return [
            'items' => $response['result']['results'] ?? [],
            'total' => $response['result']['count'] ?? 0,
        ];
    }

    public function paginatedOrganizations($page = 1, $perPage = 10, $keyword = null)
    {
        $all = $this->listOrganizations();

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
            'total' => $total,
        ];
    }

    public function listGroups($allFields = true)
    {
        try {
            $response = Http::timeout(10) // batas waktu request
                ->get($this->baseUrl.'/api/3/action/group_list', [
                    'all_fields' => $allFields,
                ]);

            // cek apakah response sukses
            if ($response->successful()) {
                return $response->json()['result'] ?? [];
            }

            // jika server balas error (500, 404, dll)
            return [
                'error' => true,
                'message' => 'Server merespon dengan status: '.$response->status(),
            ];
        } catch (\Exception $e) {
            // jika server mati / tidak bisa diakses
            return [
                'error' => true,
                'message' => 'Server tidak dapat diakses: '.$e->getMessage(),
            ];
        }
    }

    public function getGroup($id)
    {
        $response = Http::get($this->baseUrl.'/api/3/action/group_show', [
            'id' => $id,
        ]);

        return $response->json()['result'] ?? null;
    }

    public function groupDatasets($page = 1, $perPage = 10, $keyword = null)
    {

        $start = ($page - 1) * $perPage;
        $response = Http::get($this->baseUrl.'/api/3/action/package_search', [
            'fq' => "groups:$keyword",
            'start' => $start,
            'rows' => 100,
        ]);

        $datasets = collect($response['result']['results']);

        return [
            'items' => $datasets,
            'total' => $response['result']['count'] ?? 0,
        ];
    }

    /**
     * Total number of registered organizations (OPD), regardless of whether
     * they have published any dataset yet.
     */
    public function countOrganizations(): int
    {
        try {
            $response = Http::timeout(10)->get($this->baseUrl.'/api/3/action/organization_list');

            return $response->successful() ? count($response->json('result', [])) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Aggregated stats for the admin dashboard: dataset totals, growth this
     * month/year, a breakdown by organization and by topic (group), and a
     * monthly trend series. Fails soft — on any error every value falls back
     * to zero/empty rather than throwing, matching the rest of this service.
     */
    public function dashboardDatasetStats(int $months = 9, int $topN = 8): array
    {
        $empty = [
            'total_datasets' => 0,
            'total_organizations' => 0,
            'datasets_this_month' => 0,
            'datasets_this_year' => 0,
            'by_organization' => [],
            'by_organization_total' => 0,
            'by_topic' => [],
            'by_topic_total' => 0,
            'monthly_series' => [],
        ];

        try {
            // One call gets the grand total plus a facet breakdown by
            // organization and by group (topic) in a single round trip.
            $facetResponse = Http::timeout(10)->get($this->baseUrl.'/api/3/action/package_search', [
                'rows' => 0,
                'facet.field' => json_encode(['organization', 'groups']),
                'facet.limit' => -1,
            ]);

            if (! $facetResponse->successful()) {
                return $empty;
            }

            $result = $facetResponse->json('result', []);
            $facets = $result['search_facets'] ?? [];

            $mapFacet = function (array $items) {
                return collect($items)
                    ->map(fn ($item) => [
                        'label' => $item['display_name'] ?? $item['name'] ?? '—',
                        'count' => (int) ($item['count'] ?? 0),
                    ])
                    ->sortByDesc('count')
                    ->values();
            };

            $byOrganization = $mapFacet($facets['organization']['items'] ?? []);
            $byTopic = $mapFacet($facets['groups']['items'] ?? []);

            $now = now();

            return [
                'total_datasets' => (int) ($result['count'] ?? 0),
                'total_organizations' => $this->countOrganizations(),
                'datasets_this_month' => $this->countDatasetsSince($now->copy()->startOfMonth()),
                'datasets_this_year' => $this->countDatasetsSince($now->copy()->startOfYear()),
                'by_organization' => $byOrganization->take($topN)->all(),
                'by_organization_total' => $byOrganization->count(),
                'by_topic' => $byTopic->take($topN)->all(),
                'by_topic_total' => $byTopic->count(),
                'monthly_series' => $this->monthlyDatasetCounts($months),
            ];
        } catch (\Exception $e) {
            return $empty;
        }
    }

    /**
     * Count datasets whose metadata_created falls in [$start, NOW].
     */
    protected function countDatasetsSince($start): int
    {
        return $this->countDatasetsInRange($start, null);
    }

    /**
     * Count datasets whose metadata_created falls in [$start, $end).
     * $end = null means open-ended (up to NOW).
     */
    protected function countDatasetsInRange($start, $end = null): int
    {
        try {
            $fq = sprintf(
                'metadata_created:[%s TO %s]',
                $start->clone()->utc()->format('Y-m-d\TH:i:s\Z'),
                $end ? $end->clone()->utc()->format('Y-m-d\TH:i:s\Z') : 'NOW'
            );

            $response = Http::timeout(10)->get($this->baseUrl.'/api/3/action/package_search', [
                'rows' => 0,
                'fq' => $fq,
            ]);

            return $response->successful() ? (int) ($response->json('result.count') ?? 0) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Dataset additions per month for the last $months months (oldest first).
     */
    protected function monthlyDatasetCounts(int $months): array
    {
        $now = now();
        $series = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $monthStart = $now->copy()->subMonths($i)->startOfMonth();
            $monthEnd = $monthStart->copy()->addMonthNoOverflow();

            $series[] = [
                'label' => $monthStart->translatedFormat('M'),
                'count' => $this->countDatasetsInRange($monthStart, $monthEnd),
            ];
        }

        return $series;
    }
}
