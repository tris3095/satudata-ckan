<?php

namespace Tests\Unit;

use App\Services\CkanService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CkanServiceTest extends TestCase
{
    public function test_paginated_organizations_fetches_all_ckan_batches(): void
    {
        config(['ckan.url' => 'https://ckan.test']);

        $organizations = array_map(
            fn (int $number) => [
                'name' => "organization-{$number}",
                'title' => "Organization {$number}",
            ],
            range(1, 55)
        );

        Http::fake(function ($request) use ($organizations) {
            $offset = (int) $request['offset'];
            $limit = (int) $request['limit'];

            return Http::response([
                'success' => true,
                'result' => array_slice($organizations, $offset, $limit),
            ]);
        });

        $result = (new CkanService)->paginatedOrganizations(5, 12);

        $this->assertSame(55, $result['total']);
        $this->assertCount(7, $result['items']);
        $this->assertSame('organization-49', $result['items'][0]['name']);

        Http::assertSentCount(3);
        Http::assertSent(fn ($request) => str_starts_with($request->url(), 'https://ckan.test/api/3/action/organization_list')
            && $request['all_fields'] === true
            && (int) $request['limit'] === 25
            && (int) $request['offset'] === 50
        );
    }

    public function test_count_organizations_counts_the_raw_list(): void
    {
        config(['ckan.url' => 'https://ckan.test']);

        Http::fake([
            'https://ckan.test/api/3/action/organization_list' => Http::response([
                'success' => true,
                'result' => ['dinas-a', 'dinas-b', 'dinas-c'],
            ]),
        ]);

        $this->assertSame(3, (new CkanService)->countOrganizations());
    }

    public function test_count_organizations_fails_soft_when_ckan_is_unreachable(): void
    {
        config(['ckan.url' => 'https://ckan.test']);

        Http::fake([
            'https://ckan.test/api/3/action/organization_list' => Http::response(null, 500),
        ]);

        $this->assertSame(0, (new CkanService)->countOrganizations());
    }

    public function test_dashboard_dataset_stats_aggregates_facets_and_counts(): void
    {
        config(['ckan.url' => 'https://ckan.test']);

        Http::fake(function ($request) {
            $url = $request->url();

            if (str_contains($url, 'organization_list')) {
                return Http::response([
                    'success' => true,
                    'result' => ['dinas-a', 'dinas-b', 'dinas-c'],
                ]);
            }

            if (str_contains($url, 'package_search') && str_contains($url, 'facet.field')) {
                return Http::response([
                    'success' => true,
                    'result' => [
                        'count' => 961,
                        'search_facets' => [
                            'organization' => [
                                'items' => [
                                    ['name' => 'dinas-a', 'display_name' => 'Dinas A', 'count' => 50],
                                    ['name' => 'dinas-b', 'display_name' => 'Dinas B', 'count' => 200],
                                ],
                            ],
                            'groups' => [
                                'items' => [
                                    ['name' => 'ekonomi', 'display_name' => 'Ekonomi', 'count' => 30],
                                ],
                            ],
                        ],
                    ],
                ]);
            }

            // Every metadata_created range query (monthly series + month/year totals)
            return Http::response([
                'success' => true,
                'result' => ['count' => 7],
            ]);
        });

        $stats = (new CkanService)->dashboardDatasetStats(months: 3);

        $this->assertSame(961, $stats['total_datasets']);
        $this->assertSame(3, $stats['total_organizations']);
        $this->assertSame(7, $stats['datasets_this_month']);
        $this->assertSame(7, $stats['datasets_this_year']);

        // Facet items are sorted by count descending, highest first.
        $this->assertSame('Dinas B', $stats['by_organization'][0]['label']);
        $this->assertSame(200, $stats['by_organization'][0]['count']);
        $this->assertSame(2, $stats['by_organization_total']);

        $this->assertSame('Ekonomi', $stats['by_topic'][0]['label']);
        $this->assertSame(1, $stats['by_topic_total']);

        $this->assertCount(3, $stats['monthly_series']);
        $this->assertSame(7, $stats['monthly_series'][0]['count']);
        $this->assertArrayHasKey('label', $stats['monthly_series'][0]);
    }

    public function test_dashboard_dataset_stats_fails_soft_when_ckan_is_unreachable(): void
    {
        config(['ckan.url' => 'https://ckan.test']);

        Http::fake([
            'https://ckan.test/api/3/action/package_search*' => Http::response(null, 500),
        ]);

        $stats = (new CkanService)->dashboardDatasetStats();

        $this->assertSame([
            'total_datasets' => 0,
            'total_organizations' => 0,
            'datasets_this_month' => 0,
            'datasets_this_year' => 0,
            'by_organization' => [],
            'by_organization_total' => 0,
            'by_topic' => [],
            'by_topic_total' => 0,
            'monthly_series' => [],
        ], $stats);
    }
}
