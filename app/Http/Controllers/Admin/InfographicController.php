<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InfographicController extends Controller
{
    private $link;

    public function __construct()
    {
        $this->link = 'public/infographic/';
    }

    public function index()
    {
        $datas = Infographic::orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pages.infographic.index', compact('datas'))->with('title', 'Infografis');
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request, Infographic $infographic)
    {
        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'file'  => 'required|image',
            ];

            $messages = [
                'title.required'            => 'Judul wajib diisi.',
                'file.required'             => 'Gambar wajib diunggah.',
                'file.image'                => 'Format file harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',
                'start_date.required'       => 'Tanggal mulai wajib diisi jika status sesuai periode.',
                'end_date.required'         => 'Tanggal selesai wajib diisi jika status sesuai periode.',
                'end_date.after_or_equal'   => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            ];

            if ($request->input('is_active') == 0) {
                $rules['start_date'] = 'required|date';
                $rules['end_date']   = 'required|date|after_or_equal:start_date';
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {
                $filename = time() . '.' . $request->file->extension();
                Storage::putFileAs($this->link, $request->file("file"), $filename);

                $infographic->title      = $request->title;
                $infographic->image_path = $filename;
                $infographic->link_url   = $request->link_url;
                $infographic->is_active  = $request->is_active;
                $infographic->start_date = $request->start_date;
                $infographic->end_date   = $request->end_date;
                $infographic->save();

                return response()->json(['success' => 'Data berhasil ditambah']);
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Request $request, Infographic $infographic)
    {
        if ($request->ajax()) {
            return response()->json($infographic);
        }
    }

    public function update(Request $request, Infographic $infographic)
    {
        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'file'  => 'image',
            ];

            $messages = [
                'title.required'          => 'Judul wajib diisi.',
                'file.image'              => 'Format file harus berupa gambar (jpg, jpeg, png, bmp, gif, svg, webp).',
                'start_date.required'     => 'Tanggal mulai wajib diisi jika status sesuai periode.',
                'end_date.required'       => 'Tanggal selesai wajib diisi jika status sesuai periode.',
                'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            ];

            if ($request->input('is_active') == 0) {
                $rules['start_date'] = 'required|date';
                $rules['end_date']   = 'required|date|after_or_equal:start_date';
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {
                $infographic->title = $request->title;
                if ($request->file("file") != "") {
                    $filename = time() . '.' . $request->file->extension();
                    Storage::delete($this->link . $infographic->image_path);
                    Storage::putFileAs($this->link, $request->file("file"), $filename);
                    $infographic->image_path = $filename;
                }
                $infographic->link_url   = $request->link_url;
                $infographic->is_active  = $request->is_active;
                if ($request->input('is_active') == 0) {
                    $infographic->start_date = $request->start_date;
                    $infographic->end_date   = $request->end_date;
                } else {
                    $infographic->start_date = null;
                    $infographic->end_date   = null;
                }
                $infographic->save();

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }
    }

    public function destroy(Request $request, Infographic $infographic)
    {
        if ($request->ajax()) {
            Storage::delete($this->link . $infographic->image_path);
            Infographic::destroy($infographic->id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    }
}
