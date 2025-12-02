<?php

namespace Database\Seeders;

use App\Models\Infographic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfographicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Inflasi Oktober 2024 Year on Year (yoy) Provinsi Sumatera Selatan Sebesar 1,09 Persen',
                'image' => 'inflasi-oktober-2024.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-10-20',
            ],
            [
                'title' => 'Data Kemiskinan Sumatera Selatan',
                'image' => 'kemiskinan-sumsel.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-09-28',
            ],
            [
                'title' => 'Perkembangan Nilai Tukar Petani',
                'image' => 'ntp-sumsel.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-09-18',
            ],
            [
                'title' => 'Luas Panen dan Produksi Padi Provinsi Sumatera Selatan 2024',
                'image' => 'padi-sumsel-2024.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-08-30',
            ],
            [
                'title' => 'Perkembangan Ekspor dan Impor Sumatera Selatan September 2024',
                'image' => 'ekspor-impor-sept-2024.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-09-30',
            ],
            [
                'title' => 'Pertumbuhan Ekonomi Provinsi Sumatera Selatan Triwulan III-2024',
                'image' => 'pertumbuhan-ekonomi-q3-2024.jpg',
                'source' => 'BPS Sumatera Selatan',
                'published_at' => '2024-11-05',
            ]
        ];

        foreach ($data as $item) {
            Infographic::create([
                'title'        => $item['title'],
                'image'    => $item['image'],
                'source'       => $item['source'],
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
