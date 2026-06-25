<?php

namespace Database\Seeders;

use App\Models\SurveiPertanyaan;
use Illuminate\Database\Seeder;

class SurveiPertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertanyaans = [
            ['kode' => 'a', 'pertanyaan' => 'Seberapa mudah Anda menemukan data/informasi di website ini?', 'tipe' => 'skala', 'urutan' => 1],
            ['kode' => 'b', 'pertanyaan' => 'Seberapa mudah Anda menemukan fitur lainnya di website ini?', 'tipe' => 'skala', 'urutan' => 2],
            ['kode' => 'c', 'pertanyaan' => 'Bagaimana Anda menilai kecepatan memuat (loading) halaman website kami?', 'tipe' => 'skala', 'urutan' => 3],
            ['kode' => 'd', 'pertanyaan' => 'Apakah desain dan tata letak website terasa mudah/nyaman saat dilihat?', 'tipe' => 'skala', 'urutan' => 4],
            ['kode' => 'e', 'pertanyaan' => 'Apakah informasi yang ada di website ini akurat dan mudah dipahami?', 'tipe' => 'skala', 'urutan' => 5],
            ['kode' => 'f', 'pertanyaan' => 'Seberapa puas Anda dengan kelengkapan informasi terkait produk/layanan yang kami tawarkan?', 'tipe' => 'skala', 'urutan' => 6],
            ['kode' => 'g', 'pertanyaan' => 'Apakah Anda pernah menggunakan layanan Whatsapp Halo Satu Data Sumsel?', 'tipe' => 'ya_tidak', 'urutan' => 7],
            ['kode' => 'h', 'pertanyaan' => 'Seberapa cepat dan tanggap tim Halo Satu Data Sumsel kami dalam merespons pertanyaan/kendala Anda?', 'tipe' => 'skala', 'urutan' => 8, 'is_conditional' => true],
            ['kode' => 'i', 'pertanyaan' => 'Apakah solusi yang diberikan oleh tim Halo Satu Data Sumsel kami membantu menyelesaikan masalah Anda?', 'tipe' => 'skala', 'urutan' => 9, 'is_conditional' => true],
            ['kode' => 'j', 'pertanyaan' => 'Kritik dan saran membangun', 'tipe' => 'teks', 'urutan' => 10, 'is_required' => false],
        ];

        foreach ($pertanyaans as $pertanyaan) {
            SurveiPertanyaan::updateOrCreate(
                ['kode' => $pertanyaan['kode']],
                $pertanyaan
            );
        }
    }
}
