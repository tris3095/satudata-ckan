<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GeoportalService
{
    private $baseUrl = 'https://geoportal.sumselprov.go.id/api/record/publik';
    protected $baseUrl2 = "https://geoportal.sumselprov.go.id/geoserver/palapa/wms/reflect";
    public function getAll()
    {
        $response = Http::get($this->baseUrl);

        if (!$response->successful()) {
            return [];
        }

        $data = $response->json();

        // memastikan respons berupa array
        $data = $response->json();

        // Format setiap item
        return collect($data)->map(function ($item) {
            // --- 1. Ambil layer name dari links
            $layer = $this->parseLayerName($item['links'] ?? '');

            // --- 2. Build URL Thumbnail (jika ada layer)
            $item['thumbnail'] = $layer
                ? "{$this->baseUrl2}?layers={$layer}"
                : null;

            // --- 3. Generate inisial organisasi
            $item['org_initial'] = $this->generateInitial($item['organization'] ?? 'Unknown');

            return $item;
        })->toArray();
    }
    private function parseLayerName(string $links)
    {
        $parts = explode(',', $links);

        foreach ($parts as $p) {
            $p = trim($p);

            if (Str::startsWith($p, 'palapa:')) {
                return $p; // contoh: "palapa:JASLINGPENYEDIAPANGAN_SUMSEL"
            }
        }

        return null;
    }

    /**
     * Generate initial organisasi, contoh:
     * "Dinas Lingkungan Hidup dan Pertanahan Provinsi Sumatera Selatan" → "DLHP"
     */
    private function generateInitial(string $org)
    {
        if (!$org || $org === 'Unknown') {
            return 'ORG';
        }

        $words = collect(explode(' ', $org))
            ->filter(fn($w) => strlen($w) > 2)
            ->take(4)
            ->map(fn($w) => strtoupper($w[0]));

        return $words->implode('') ?: 'ORG';
    }
}
