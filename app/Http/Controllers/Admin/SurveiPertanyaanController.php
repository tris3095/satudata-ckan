<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveiPertanyaan;

class SurveiPertanyaanController extends Controller
{
    public function index()
    {
        $datas = SurveiPertanyaan::urut()->paginate(10);

        return view('admin.pages.survei-pertanyaan.index', compact('datas'))->with('title', 'Survei Kepuasan Konsumen');
    }

    public function create()
    {
        abort(404);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }
}
