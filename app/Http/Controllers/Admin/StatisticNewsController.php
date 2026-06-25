<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatisticNews;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StatisticNewsController extends Controller
{
    private $link;

    public function __construct()
    {
        $this->link = 'public/brs/';
    }

    public function index()
    {
        $datas = StatisticNews::orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pages.brs.index', compact('datas'))->with('title', 'Berita Statistik');
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request, StatisticNews $brs)
    {        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'description' => 'nullable',
                'file'  => 'required|image',
                'materi' => 'nullable|mime:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,image/gif,image/bmp',
            ];

            $messages = [
                'title.required'            => 'Judul wajib diisi.',

                'file.required'             => 'Gambar wajib diunggah.',
                'file.image'                => 'Format file harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',
                'materi.mimes'              => 'Format file harus berupa pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, png, gif, bmp, jpeg.',
            ];



            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal  menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {
                $filename = time() . '.' . $request->file->extension();
                Storage::putFileAs($this->link, $request->file("file"), $filename);
                $materi = Timestamp::now() . '.' . $request->materi->extension();
                Storage::putFileAs($this->link, $request->file("materi"), $materi);
                $brs->title      = $request->title;
                $brs->image_path = $filename;
                $brs->materi = $materi;
                $brs->description = $request->description;
                $brs->is_active  = $request->is_active;
                $brs->user_id    =  Auth::id();
                $brs->save();

                return response()->json(['success' => 'Data berhasil ditambah']);
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Request $request, StatisticNews $brs)
    {
        if ($request->ajax()) {
            return response()->json($brs);
        }
    }

    public function update(Request $request, StatisticNews $brs)
    {
        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'file'  => 'image',
            ];

            $messages = [
                'title.required'          => 'Judul wajib diisi.',
                'file.image'              => 'Format file harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',

            ];


            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {
                $brs->title = $request->title;
                if ($request->file("file") != "") {
                    $filename = time() . '.' . $request->file->extension();
                    Storage::delete($this->link . $brs->image_path);
                    Storage::putFileAs($this->link, $request->file("file"), $filename);
                    $brs->image_path = $filename;
                }
                $brs->link_url   = $request->link_url;
                $brs->is_active  = $request->is_active;
                if ($request->input('is_active') == 0) {
                    $brs->start_date = $request->start_date;
                    $brs->end_date   = $request->end_date;
                } else {
                    $brs->start_date = null;
                    $brs->end_date   = null;
                }
                $brs->save();

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }
    }

    public function destroy(Request $request, StatisticNews $brs)
    {
        if ($request->ajax()) {
            Storage::delete($this->link . $brs->image_path);
            StatisticNews::destroy($brs->id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    }
}
