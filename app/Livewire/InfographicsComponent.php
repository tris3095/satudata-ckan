<?php

namespace App\Livewire;

use App\Models\Infographic;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class InfographicsComponent extends Component
{
    use WithFileUploads;
    public $titlePage;
    public $title, $file, $status, $source;
    public $showModal = false;
    public $editId = null;
    public $oldImage = null;

    protected $listeners = ['delete'];

    protected $rules = [
        'title'  => 'required|string|max:255',
        'file'   => 'nullable|image|max:2048',
        'status' => 'required|boolean',
        'source' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'title.required' => 'Judul wajib diisi',
        'title.max'      => 'Judul maksimal 255 karakter',
        'file.required'  => 'Gambar wajib diunggah',
        'file.image'     => 'File harus berupa gambar',
        'file.max'       => 'Ukuran gambar maksimal 2 MB',
        'status.required' => 'Status harus dipilih',
        'source.max'     => 'Sumber maksimal 255 karakter',
    ];

    public function getDatasProperty()
    {
        return Infographic::latest()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['title', 'file', 'status', 'source', 'editId', 'oldImage']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = Infographic::findOrFail($id);

        $this->editId   = $id;
        $this->title    = $data->title;
        $this->status   = $data->is_active;
        $this->source   = $data->source;
        $this->oldImage = $data->image;

        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {
        if (!$this->editId) {
            $this->validate([
                'title'  => 'required|string|max:255',
                'file'   => 'required|image|max:2048',
                'status' => 'required|boolean',
                'source' => 'nullable|string|max:255',
            ]);
        }

        $this->validate();

        try {
            if ($this->file) {
                if ($this->oldImage && Storage::disk('public')->exists('infographics/' . $this->oldImage)) {
                    Storage::disk('public')->delete('infographics/' . $this->oldImage);
                }
                $filename = time() . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('infographics', $filename, 'public');
            } else {
                $filename = $this->oldImage;
            }

            Infographic::updateOrCreate(
                ['id' => $this->editId],
                [
                    'title'  => $this->title,
                    'is_active' => $this->status,
                    'source' => $this->source,
                    'image'  => $filename,
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
            $data = Infographic::findOrFail($id);

            if ($data->image && Storage::disk('public')->exists('infographics/' . $data->image)) {
                Storage::disk('public')->delete('infographics/' . $data->image);
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
        return view('livewire.infographics-component');
    }
}
