<?php

namespace App\Http\Controllers;

use App\Models\SurveiJawaban;
use App\Models\SurveiPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SurveiController extends Controller
{
    const SUBMITTED_COOKIE = 'survei_submitted';

    public function index(Request $request)
    {
        $alreadySubmitted = $request->cookie(self::SUBMITTED_COOKIE) === '1';

        if ($alreadySubmitted) {
            return view('survei.index', ['pertanyaans' => collect(), 'alreadySubmitted' => true]);
        }

        $pertanyaans = SurveiPertanyaan::active()->urut()->get();

        return view('survei.index', compact('pertanyaans'))->with('alreadySubmitted', false);
    }

    public function store(Request $request)
    {
        if ($request->cookie(self::SUBMITTED_COOKIE) === '1') {
            return redirect()->route('survei.index');
        }

        $pertanyaans = SurveiPertanyaan::active()->urut()->get();

        $rules = [];
        $gateAnswer = null;
        foreach ($pertanyaans as $pertanyaan) {
            $field = 'jawaban.' . $pertanyaan->id;

            if ($pertanyaan->tipe === 'ya_tidak') {
                $rules[$field] = 'required|in:1,2';
                $gateAnswer = (int) $request->input($field);
            } elseif ($pertanyaan->is_conditional && $gateAnswer !== 2) {
                // Skipped because the preceding gate question was answered "Tidak Pernah".
                $rules[$field] = 'nullable';
            } elseif ($pertanyaan->tipe === 'teks') {
                $rules[$field] = $pertanyaan->is_required ? 'required|string|max:2000' : 'nullable|string|max:2000';
            } else {
                $rules[$field] = 'required|integer|min:1|max:5';
            }
        }

        $messages = [
            '*.required' => 'Mohon lengkapi semua pertanyaan yang wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SurveiJawaban::create([
            'jawaban'    => $request->input('jawaban', []),
            'ip_address' => $request->ip(),
        ]);

        Cookie::queue(self::SUBMITTED_COOKIE, '1', 60 * 24 * 365);

        return redirect()->route('survei.index')->with('success', 'Terima kasih, jawaban survei Anda berhasil dikirim.');
    }
}
