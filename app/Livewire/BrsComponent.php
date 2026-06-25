<?php

namespace App\Livewire;

use App\Models\StatisticNews;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class BrsComponent extends Component
{
    use WithFileUploads;
    public $titlePage;
    public $title,  $description, $file, $slug, $size, $rilis_date, $status, $materi;
    public $showModal = false;
    public $editId = null;
    public $oldImage, $oldMateri = null;

    protected $listeners = ['delete'];

    protected $rules = [
        'title'  => 'required|string|max:255',
        'description' => 'nullable',
        'file'   => 'nullable|image|max:2048',
        'materi' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        'rilis_date' => 'nullable|date',


    ];

    protected $messages = [
        'title.required' => 'Judul wajib diisi',
        'title.max'      => 'Judul maksimal 255 karakter',
        'file.required'  => 'Gambar wajib diunggah',
        'file.image'     => 'File harus berupa gambar',
        'file.max'       => 'Ukuran gambar maksimal 2 MB',
        'rilis_date.required' => 'Tanggal wajib diisi',
        'materi.required' => 'Materi wajib diunggah',
        'materi.max' => 'Ukuran materi maksimal 10Mb',


    ];

    public function getDatasProperty()
    {
        return StatisticNews::latest()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['title', 'file', 'oldImage', 'oldMateri', 'rilis_date', 'status', 'materi', 'description', 'editId']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = StatisticNews::findOrFail($id);

        $this->editId   = $id;
        $this->title    = $data->title;
        $this->status   = $data->is_active ? '1' : '0';
        $this->description = $data->description;
        $this->slug = $data->slug;
        $this->oldImage = $data->image_path;
        $this->oldMateri = $data->materi;
        $this->rilis_date = $data->rilis_date;

        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {

        if (!$this->editId) {
            if ($this->status == 0) {
                $this->validate([
                    'title'  => 'required|string|max:255',
                    'description' => 'nullable',
                    'file'   => 'required|image|max:2048',
                    'materi' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',


                ]);
            } else {
                $this->validate([
                    'title'  => 'required|string|max:255',
                    'description' => 'nullable',
                    'file'   => 'required|image|max:2048',
                    'materi' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',


                ]);
            }
        }

        if ($this->status == 0) {
            $this->validate([
                'title'  => 'required|string|max:255',
                'file'   => 'nullable|image|max:2048',
                'materi' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
                'description' => 'nullable',


            ]);
        } else {
            $this->validate([
                'title'  => 'required|string|max:255',
                'description' => 'nullable',
                'file'   => 'nullable|image|max:2048',
                'materi' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',

            ]);
        }

        try {
            if ($this->file) {
                if ($this->oldImage && Storage::disk('public')->exists('brs/' . $this->oldImage)) {
                    Storage::disk('public')->delete('brs/' . $this->oldImage);
                }
                $filename =  uniqid()  . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('brs', $filename, 'public');
                $materi =  uniqid()   . '.' . $this->materi->getClientOriginalExtension();

                $this->materi->storeAs('brs', $materi, 'public');
                $size = $this->materi->getSize();
            } else {
                $filename = $this->oldImage;
            }

            StatisticNews::updateOrCreate(
                ['id' => $this->editId],
                [
                    'title'  => $this->title,
                    'slug' => Str::slug($this->title),
                    'description' => $this->description,
                    'materi' => $materi,
                    'rilis_date' => $this->rilis_date,
                    'size' => $size,
                    'image_path'  => $filename,
                    'is_active' => $this->status,
                    'user_id' => auth()->user()->id,


                ]
            );

            $this->closeModal();

            $this->notify(
                'success',
                $this->editId ? 'Data berhasil diubah' : 'Data berhasil disimpan'
            );
        } catch (\Throwable $e) {
            $this->notify('error', 'Gagal menyimpan data' . $e->getMessage());
        }
    }

    public function triggerDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Apakah kamu yakin?',
            'text' => 'Data ini akan dihapus permanen!',
            'icon' => 'warning',
        ]);
    }

    public function delete($id)
    {
        try {
            $data = StatisticNews::findOrFail($id);

            if ($data->image && Storage::disk('public')->exists('brs/' . $data->image)) {
                Storage::disk('public')->delete('brs/' . $data->image);
            }

            $data->delete();

            $this->notify('success', 'Data berhasil dihapus');
        } catch (\Throwable $e) {
            $this->notify('error', 'Gagal menghapus data');
        }
    }

    private function notify($type, $message)
    {
        $this->dispatch('notify', [
            'type' => $type,
            'message' => $message
        ]);
    }
    public function render()
    {
        return view('livewire.brs-component');
    }
}
