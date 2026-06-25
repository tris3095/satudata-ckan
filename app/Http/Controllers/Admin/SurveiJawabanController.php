<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveiJawaban;
use App\Models\SurveiPertanyaan;

class SurveiJawabanController extends Controller
{
    public function index()
    {
        $pertanyaans = SurveiPertanyaan::urut()->get();
        $jawabans    = SurveiJawaban::all();
        $totalResponses = $jawabans->count();

        $analitik = $this->buildAnalitik($pertanyaans, $jawabans);

        $semuaSkala = collect();
        foreach ($pertanyaans->where('tipe', 'skala') as $pertanyaan) {
            foreach ($jawabans as $jawaban) {
                $value = data_get($jawaban->jawaban, $pertanyaan->id);
                if ($value !== null && $value !== '') {
                    $semuaSkala->push((int) $value);
                }
            }
        }
        $rataRataKeseluruhan = $semuaSkala->isNotEmpty() ? round($semuaSkala->avg(), 2) : null;

        $datas = SurveiJawaban::orderBy('id', 'desc')->paginate(10);
        $datas->getCollection()->transform(function ($item) use ($pertanyaans) {
            $item->detail = $this->mapJawabanDetail($item, $pertanyaans);
            return $item;
        });

        return view('admin.pages.survei-jawaban.index', compact(
            'totalResponses',
            'analitik',
            'rataRataKeseluruhan',
            'datas'
        ))->with('title', 'Hasil Survei Kepuasan');
    }

    private function buildAnalitik($pertanyaans, $jawabans)
    {
        $analitik = [];

        foreach ($pertanyaans as $pertanyaan) {
            $answers = $jawabans
                ->map(fn($jawaban) => data_get($jawaban->jawaban, $pertanyaan->id))
                ->filter(fn($value) => $value !== null && $value !== '');

            if ($pertanyaan->tipe === 'skala') {
                $distribusi = [];
                for ($i = 1; $i <= 5; $i++) {
                    $count = $answers->filter(fn($value) => (int) $value === $i)->count();
                    $distribusi[$i] = [
                        'count'      => $count,
                        'percentage' => $answers->count() ? round($count / $answers->count() * 100) : 0,
                    ];
                }

                $analitik[$pertanyaan->id] = [
                    'pertanyaan'    => $pertanyaan,
                    'total_jawaban' => $answers->count(),
                    'rata_rata'     => $answers->isNotEmpty() ? round($answers->map(fn($v) => (int) $v)->avg(), 2) : null,
                    'distribusi'    => $distribusi,
                ];
            } elseif ($pertanyaan->tipe === 'ya_tidak') {
                $pernah      = $answers->filter(fn($value) => (int) $value === 2)->count();
                $tidakPernah = $answers->filter(fn($value) => (int) $value === 1)->count();

                $analitik[$pertanyaan->id] = [
                    'pertanyaan'        => $pertanyaan,
                    'total_jawaban'     => $answers->count(),
                    'pernah'            => $pernah,
                    'tidak_pernah'      => $tidakPernah,
                    'persentase_pernah' => $answers->count() ? round($pernah / $answers->count() * 100) : 0,
                ];
            } else {
                $analitik[$pertanyaan->id] = [
                    'pertanyaan'    => $pertanyaan,
                    'total_jawaban' => $answers->filter(fn($value) => trim((string) $value) !== '')->count(),
                    'jawaban_teks'  => $answers->filter(fn($value) => trim((string) $value) !== '')->values(),
                ];
            }
        }

        return $analitik;
    }

    private function mapJawabanDetail(SurveiJawaban $item, $pertanyaans)
    {
        return $pertanyaans->map(function ($pertanyaan) use ($item) {
            $value = data_get($item->jawaban, $pertanyaan->id);

            $label = match (true) {
                $value === null || $value === '' => '(tidak diisi)',
                $pertanyaan->tipe === 'skala'     => $value . ' / 5',
                $pertanyaan->tipe === 'ya_tidak'  => (int) $value === 2 ? 'Pernah' : 'Tidak Pernah',
                default                           => (string) $value,
            };

            return [
                'kode'       => $pertanyaan->kode,
                'pertanyaan' => $pertanyaan->pertanyaan,
                'jawaban'    => $label,
            ];
        })->values();
    }
}
