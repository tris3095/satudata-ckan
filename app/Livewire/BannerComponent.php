<?php

namespace App\Livewire;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BannerComponent extends Component
{
    use WithFileUploads;
    public $titlePage;
    public $title, $file, $status, $start_date, $end_date;
    public $showModal = false;
    public $editId = null;
    public $oldImage = null;

    protected $listeners = ['delete'];

    protected $rules = [
        'title'  => 'required|string|max:255',
        'file'   => 'nullable|image|max:2048',
        'status' => 'required|boolean',
        'start_date' => 'nullable',
        'end_date'  => 'nullable',
    ];

    protected $messages = [
        'title.required' => 'Judul wajib diisi',
        'title.max'      => 'Judul maksimal 255 karakter',
        'file.required'  => 'Gambar wajib diunggah',
        'file.image'     => 'File harus berupa gambar',
        'file.max'       => 'Ukuran gambar maksimal 2 MB',
        'status.required' => 'Status harus dipilih',
        'start_date.required' => 'Tanggal mulai wajib diisi.',
        'start_date.date'     => 'Tanggal mulai harus berupa format tanggal yang valid.',
        'end_date.required'   => 'Tanggal selesai wajib diisi.',
        'end_date.date'       => 'Tanggal selesai harus berupa format tanggal yang valid.',
        'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
    ];

    public function getDatasProperty()
    {
        return Banner::latest()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['title', 'file', 'oldImage', 'status', 'start_date', 'end_date', 'editId']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = Banner::findOrFail($id);

        $this->editId   = $id;
        $this->title    = $data->title;
        $this->status   = $data->is_active ? '1' : '0';
        $this->start_date = $data->start_date ? $data->start_date->format('Y-m-d') : null;
        $this->end_date = $data->end_date ? $data->end_date->format('Y-m-d') : null;
        $this->oldImage = $data->image_path;

        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {
        if (!$this->editId) {
            if ($this->status == 0) {
                $this->validate([
                    'title'  => 'required|string|max:255',
                    'file'   => 'required|image|max:2048',
                    'status' => 'required|boolean',
                    'start_date' => 'required|date',
                    'end_date'  => 'required|date|after_or_equal:start_date',
                ]);
            } else {
                $this->validate([
                    'title'  => 'required|string|max:255',
                    'file'   => 'required|image|max:2048',
                    'status' => 'required|boolean',
                    'start_date' => 'nullable',
                    'end_date'  => 'nullable',
                ]);
            }
        }

        if ($this->status == 0) {
            $this->validate([
                'title'  => 'required|string|max:255',
                'file'   => 'nullable|image|max:2048',
                'status' => 'required|boolean',
                'start_date' => 'required|date',
                'end_date'  => 'required|date|after_or_equal:start_date',
            ]);
        } else {
            $this->validate([
                'title'  => 'required|string|max:255',
                'file'   => 'nullable|image|max:2048',
                'status' => 'required|boolean',
                'start_date' => 'nullable',
                'end_date'  => 'nullable',
            ]);
        }

        try {
            if ($this->file) {
                if ($this->oldImage && Storage::disk('public')->exists('banner/' . $this->oldImage)) {
                    Storage::disk('public')->delete('banner/' . $this->oldImage);
                }
                $filename = time() . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('banner', $filename, 'public');
            } else {
                $filename = $this->oldImage;
            }

            Banner::updateOrCreate(
                ['id' => $this->editId],
                [
                    'title'  => $this->title,
                    'image_path'  => $filename,
                    'is_active' => $this->status,
                    'start_date' => $this->status == 1 ? null : $this->start_date,
                    'end_date'   => $this->status == 1 ? null : $this->end_date,
                ]
            );

            $this->closeModal();

            $this->notify(
                'success',
                $this->editId ? 'Data berhasil diubah' : 'Data berhasil disimpan'
            );
        } catch (\Throwable $e) {
            $this->notify('error', 'Gagal menyimpan data');
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
            $data = Banner::findOrFail($id);

            if ($data->image && Storage::disk('public')->exists('banner/' . $data->image)) {
                Storage::disk('public')->delete('banner/' . $data->image);
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
        return view('livewire.banner-component');
    }
}
