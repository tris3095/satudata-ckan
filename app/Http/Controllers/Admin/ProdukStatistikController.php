<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukStatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ProdukStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $link;

    public function __construct()
    {
        $this->link = 'public/prs/';
    }
    public function index()
    {
        $datas = ProdukStatistik::orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.pages.prs.index', compact('datas'))->with('title', 'Produk Resmi Statistik');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProdukStatistik $brs)
    {
        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'description' => 'nullable',
                'isbn' => 'nullable',
                'no_katalog' => 'nullable',
                'tanggal_rilis' => 'nullable',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10480',
                'document' => 'nullable|mime:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,image/gif,image/bmp',
            ];

            $messages = [
                'title.required'            => 'Judul wajib diisi.',
                'document.mimes'              => 'Format file harus berupa pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, png, gif, bmp, jpeg.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal  menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {

                $filename = time() . '.' . $request->file('document')->extension();
                Storage::putFileAs($this->link, $request->file("document"), $filename);
                $thumbnailPath = storage_path('prs/thumbnails');
                if (!file_exists($thumbnailPath)) {
                    mkdir($thumbnailPath, 0777, true);
                }
                if ($request->hasFile('thumbnail')) {
                    $thumbnail = $request->file('thumbnail');
                    $imageName = time() . '.' . $thumbnail->extension();
                    $img = Image::make($thumbnail->path());
                    $img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbnailPath . '/' . $imageName);
                } else {
                    $imageName = null;
                }
            }
            $brs->title      = $request->title;
            $brs->slug = Str::slug($request->title);
            $brs->document = $filename;
            $brs->isbn = $request->isbn;
            $brs->no_katalog = $request->no_katalog;
            $brs->tanggal_rilis = $request->tanggal_rilis;
            $brs->thumbnail = $imageName;


            $brs->description = $request->description;
            $brs->is_active  = $request->is_active;
            $brs->user_id    =  Auth::id();
            $brs->save();

            return response()->json(['success' => 'Data berhasil ditambah']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdukStatistik $produkStatistik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ProdukStatistik $prs)
    {
        if ($request->ajax()) {
            return response()->json($prs);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdukStatistik $brs)
    {
        if ($request->ajax()) {
            $rules = [
                'title' => 'required',
                'description' => 'nullable',

                'document' => 'nullable|mime:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpeg,image/png,image/gif,image/bmp',
            ];

            $messages = [
                'title.required'            => 'Judul wajib diisi.',
                'document.mimes'              => 'Format file harus berupa pdf, doc, docx, xls, xlsx, ppt, pptx, jpg, png, gif, bmp, jpeg.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'error'  => "Gagal  menyimpan data",
                    'errors' => $validator->errors()
                ]);
            } else {
                $brs->title = $request->title;
                if ($request->file("document") != "") {
                    $filename = time() . '.' . $request->file('document')->extension();
                    Storage::delete($this->link . $brs->document);
                    Storage::putFileAs($this->link, $request->file("document"), $filename);
                    $brs->document = $filename;
                }



                $brs->slug = Str::slug($request->title);


                $brs->description = $request->description;
                $brs->is_active  = $request->is_active;
                $brs->user_id    =  Auth::id();
                $brs->save();

                return response()->json(['success' => 'Data berhasil diubah']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  ProdukStatistik $prs)
    {
        if ($request->ajax()) {
            Storage::delete($this->link . $prs->document);
            ProdukStatistik::destroy($prs->id);

            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    }
}
