<?php

namespace Database\Seeders;

use App\Models\Insights;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['title' => 'City/Regency Budget (APBD)', 'icon' => 'icons/apbd.png'],
            ['title' => 'Provincial Budget (APBD)', 'icon' => 'icons/apbd.png'],
            ['title' => 'Infrastructure Investment (Toll Road)', 'icon' => 'icons/investasi.png'],

            ['title' => 'Regional Stunting', 'icon' => 'icons/stunting_daerah.png'],
            ['title' => 'National Stunting', 'icon' => 'icons/stunting_nasional.png'],
            ['title' => 'National Poverty', 'icon' => 'icons/kemiskinan_nasional.png'],

            ['title' => 'Regional Poverty', 'icon' => 'icons/kemiskinan_daerah.png'],
            ['title' => 'Investment', 'icon' => 'icons/investasi.png'],
            ['title' => 'Education', 'icon' => 'icons/pendidikan.png'],

            ['title' => 'Environment', 'icon' => 'icons/lingkungan.png'],
            ['title' => 'Infrastructure', 'icon' => 'icons/infrastruktur.png'],
            ['title' => 'Food Security', 'icon' => 'icons/kp.png'],
        ];

        foreach ($items as $item) {
            Insights::create($item);
        }
    }
}
