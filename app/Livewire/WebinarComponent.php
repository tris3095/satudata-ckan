<?php

namespace App\Livewire;

use App\Models\Webinar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class WebinarComponent extends Component
{
    use WithFileUploads;
    public $titlePage;
    public $title, $file, $status, $start_date, $end_date, $materi_link, $certificate_link;
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
        'materi_link' => 'nullable|url|max:255',
        'certificate_link' => 'nullable|url|max:255',
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
        'materi_link.url'     => 'Link materi harus berupa URL yang valid.',
        'certificate_link.url' => 'Link e-sertifikat harus berupa URL yang valid.',
    ];

    public function getDatasProperty()
    {
        return Webinar::latest()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['title', 'file', 'oldImage', 'status', 'start_date', 'end_date', 'materi_link', 'certificate_link', 'editId']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = Webinar::findOrFail($id);

        $this->editId   = $id;
        $this->title    = $data->title;
        $this->status   = $data->is_active ? '1' : '0';
        $this->start_date = $data->start_date ? $data->start_date->format('Y-m-d') : null;
        $this->end_date = $data->end_date ? $data->end_date->format('Y-m-d') : null;
        $this->materi_link = $data->materi_link;
        $this->certificate_link = $data->certificate_link;
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
                    'materi_link' => 'nullable|url|max:255',
                    'certificate_link' => 'nullable|url|max:255',
                ]);
            } else {
                $this->validate([
                    'title'  => 'required|string|max:255',
                    'file'   => 'required|image|max:2048',
                    'status' => 'required|boolean',
                    'start_date' => 'nullable',
                    'end_date'  => 'nullable',
                    'materi_link' => 'nullable|url|max:255',
                    'certificate_link' => 'nullable|url|max:255',
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
                'materi_link' => 'nullable|url|max:255',
                'certificate_link' => 'nullable|url|max:255',
            ]);
        } else {
            $this->validate([
                'title'  => 'required|string|max:255',
                'file'   => 'nullable|image|max:2048',
                'status' => 'required|boolean',
                'start_date' => 'nullable',
                'end_date'  => 'nullable',
                'materi_link' => 'nullable|url|max:255',
                'certificate_link' => 'nullable|url|max:255',
            ]);
        }

        try {
            if ($this->file) {
                if ($this->oldImage && Storage::disk('public')->exists('webinar/' . $this->oldImage)) {
                    Storage::disk('public')->delete('webinar/' . $this->oldImage);
                }
                $filename = time() . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('webinar', $filename, 'public');
            } else {
                $filename = $this->oldImage;
            }

            Webinar::updateOrCreate(
                ['id' => $this->editId],
                [
                    'title'  => $this->title,
                    'image_path'  => $filename,
                    'is_active' => $this->status,
                    'start_date' => $this->status == 1 ? null : $this->start_date,
                    'end_date'   => $this->status == 1 ? null : $this->end_date,
                    'materi_link' => $this->materi_link,
                    'certificate_link' => $this->certificate_link,
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
            $data = Webinar::findOrFail($id);

            if ($data->image && Storage::disk('public')->exists('webinar/' . $data->image)) {
                Storage::disk('public')->delete('webinar/' . $data->image);
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
        return view('livewire.webinar-component');
    }
}
