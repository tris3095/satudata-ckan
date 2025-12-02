<?php

namespace App\Services;

class SumselNewsService
{
    protected $url = 'https://sumselprov.go.id/api/sumselprov/api_berita_sumsel3';

    public function getNews()
    {
        try {
            $context = stream_context_create([
                "ssl" => [
                    "verify_peer"      => false,
                    "verify_peer_name" => false,
                ]
            ]);

            $fetch = file_get_contents($this->url, false, $context);

            return json_decode($fetch, true) ?? [];
        } catch (\Throwable $th) {
            report($th);
            return [];
        }
    }
}
