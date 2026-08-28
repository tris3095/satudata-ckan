<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EsakipService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('esakip.url');
        $this->token = config('esakip.token');
    }

    public function getDocuments(int $page = 1, array $filters = [])
    {
        try {
            $query = array_filter([
                'page' => $page,
                'berkas' => $filters['berkas'] ?? null,
                'year' => $filters['year'] ?? null,
            ], fn ($value) => $value !== null && $value !== '');

            $response = Http::withToken($this->token)
                ->timeout(15)
                ->acceptJson()
                ->get($this->baseUrl, $query);

            if (!$response->successful()) {
                return [
                    'error' => true,
                    'message' => 'Gagal mengambil data (HTTP ' . $response->status() . ')',
                    'data' => [],
                ];
            }

            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'Server tidak dapat diakses: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }
}
