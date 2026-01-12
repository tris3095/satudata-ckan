<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
    private $link;

    public function __construct()
    {
        $this->link = 'public/Webinar/';
    }

    public function index()
    {
        $datas = Webinar::orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pages.webinar.index', compact('datas'))->with('title', 'Webinar');
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request, Webinar $webinar)
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

                $webinar->title      = $request->title;
                $webinar->image_path = $filename;
                $webinar->link_url   = $request->link_url;
                $webinar->is_active  = $request->is_active;
                $webinar->start_date = $request->start_date;
                $webinar->end_date   = $request->end_date;
                $webinar->save();

                return response()->json(['success' => 'Data berhasil ditambah']);
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Request $request, Webinar $webinar)
    {
        if ($request->ajax()) {
            return response()->json($webinar);
        }
    }

    public function update(Request $request, Webinar $webinar)
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
                $webinar->title = $request->title;
                if ($request->file("file") != "") {
                    $filename = time() . '.' . $request->file->extension();
                    Storage::delete($this->link . $webinar->image_path);
                    Storage::putFileAs($this->link, $request->file("file"), $filename);
                    $webinar->image_path = $filename;
                }
                $webinar->link_url   = $request->link_url;
                $webinar->is_active  = $request->is_active;
                if ($request->input('is_active') == 0) {
                    $webinar->start_date = $request->start_date;
                    $webinar->end_date   = $request->end_date;
                } else {
                    $webinar->start_date = null;
                    $webinar->end_date   = null;
                }
                $webinar->save();

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }
    }

    public function destroy(Request $request, Webinar $webinar)
    {
        if ($request->ajax()) {
            Storage::delete($this->link . $webinar->image_path);
            Webinar::destroy($webinar->id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    }
}
