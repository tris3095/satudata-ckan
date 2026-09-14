<?php

namespace Tests\Unit;

use App\Http\Controllers\InstantionController;
use App\Services\CkanService;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class InstantionControllerTest extends TestCase
{
    public function test_dataset_pagination_keeps_show_parameter(): void
    {
        $request = Request::create('/instansi/example', 'GET', [
            'show' => 1,
            'page' => 2,
        ]);
        $this->app->instance('request', $request);

        $ckan = Mockery::mock(CkanService::class);
        $ckan->shouldReceive('getOrganization')
            ->once()
            ->with('example')
            ->andReturn(['name' => 'example', 'title' => 'Example']);
        $ckan->shouldReceive('countOrganizationDatasets')
            ->once()
            ->with('example')
            ->andReturn(25);
        $ckan->shouldReceive('paginatedOrganizationDatasets')
            ->once()
            ->with('example', 2, 10)
            ->andReturn([
                'items' => array_fill(0, 10, ['name' => 'dataset']),
                'total' => 25,
            ]);

        $view = (new InstantionController($ckan))->show('example');
        $nextPageUrl = $view->getData()['datasets']->nextPageUrl();

        $this->assertStringContainsString('show=1', $nextPageUrl);
        $this->assertStringContainsString('page=3', $nextPageUrl);
    }
}
