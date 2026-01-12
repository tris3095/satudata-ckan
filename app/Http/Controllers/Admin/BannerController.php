<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    private $link;

    public function __construct()
    {
        $this->link = 'public/banner/';
    }

    public function index()
    {
        $datas = Banner::orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pages.banner.index', compact('datas'))->with('title', 'Banner');
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request, Banner $banner)
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

                $banner->title      = $request->title;
                $banner->image_path = $filename;
                $banner->link_url   = $request->link_url;
                $banner->is_active  = $request->is_active;
                $banner->start_date = $request->start_date;
                $banner->end_date   = $request->end_date;
                $banner->save();

                return response()->json(['success' => 'Data berhasil ditambah']);
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit(Request $request, Banner $banner)
    {
        if ($request->ajax()) {
            return response()->json($banner);
        }
    }

    public function update(Request $request, Banner $banner)
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
                $banner->title = $request->title;
                if ($request->file("file") != "") {
                    $filename = time() . '.' . $request->file->extension();
                    Storage::delete($this->link . $banner->image_path);
                    Storage::putFileAs($this->link, $request->file("file"), $filename);
                    $banner->image_path = $filename;
                }
                $banner->link_url   = $request->link_url;
                $banner->is_active  = $request->is_active;
                if ($request->input('is_active') == 0) {
                    $banner->start_date = $request->start_date;
                    $banner->end_date   = $request->end_date;
                } else {
                    $banner->start_date = null;
                    $banner->end_date   = null;
                }
                $banner->save();

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }
    }

    public function destroy(Request $request, Banner $banner)
    {
        if ($request->ajax()) {
            Storage::delete($this->link . $banner->image_path);
            Banner::destroy($banner->id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    }
}
