<?php

namespace App\Livewire;

use App\Models\ProdukStatistik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PrsComponent extends Component
{
    use WithFileUploads;
    public $titlePage;
    public $title, $description, $document, $thumbnail, $status;
    public $isbn, $no_katalog, $tanggal_rilis;
    public $showModal = false;
    public $editId = null;
    public $oldDocument = null;
    public $oldThumbnail = null;
    public $publishedAt = null;

    protected $listeners = ['delete'];

    protected $messages = [
        'title.required'   => 'Judul wajib diisi',
        'title.max'        => 'Judul maksimal 255 karakter',
        'document.required' => 'Dokumen wajib diunggah',
        'document.file'    => 'Dokumen harus berupa file',
        'document.mimes'   => 'Format dokumen harus pdf, doc, docx, xls, xlsx, ppt, atau pptx',
        'document.max'     => 'Ukuran dokumen maksimal 10 MB',
        'thumbnail.required' => 'Thumbnail wajib diunggah',
        'thumbnail.image'  => 'Thumbnail harus berupa gambar',
        'thumbnail.mimes'  => 'Format thumbnail harus jpg, jpeg, png, atau gif',
        'thumbnail.max'    => 'Ukuran thumbnail maksimal 2 MB',
        'status.required'  => 'Status wajib dipilih',
        'tanggal_rilis.date' => 'Tanggal rilis harus berupa tanggal yang valid',
    ];

    public function getDatasProperty()
    {
        return ProdukStatistik::latest()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['title', 'description', 'document', 'thumbnail', 'status', 'isbn', 'no_katalog', 'tanggal_rilis', 'oldDocument', 'oldThumbnail', 'publishedAt', 'editId']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = ProdukStatistik::findOrFail($id);

        $this->editId      = $id;
        $this->title       = $data->title;
        $this->description = $data->description;
        $this->status       = $data->is_active ? '1' : '0';
        $this->isbn         = $data->isbn;
        $this->no_katalog   = $data->nomor_katalog;
        $this->tanggal_rilis = $data->tanggal_rilis?->format('Y-m-d');
        $this->oldDocument  = $data->document;
        $this->oldThumbnail = $data->thumbnail;
        $this->publishedAt  = $data->published_at;
        $this->document     = null;
        $this->thumbnail    = null;

        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'document'    => ($this->editId ? 'nullable' : 'required') . '|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'thumbnail'   => ($this->editId ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'      => 'required|boolean',
            'isbn'        => 'nullable|string|max:50',
            'no_katalog'  => 'nullable|string|max:50',
            'tanggal_rilis' => 'nullable|date',
        ]);

        try {
            $documentName = $this->oldDocument;
            if ($this->document) {
                if ($this->oldDocument && Storage::disk('public')->exists('prs/' . $this->oldDocument)) {
                    Storage::disk('public')->delete('prs/' . $this->oldDocument);
                }
                $documentName = uniqid() . '.' . $this->document->getClientOriginalExtension();
                $this->document->storeAs('prs', $documentName, 'public');
            }

            $thumbnailName = $this->oldThumbnail;
            if ($this->thumbnail) {
                if ($this->oldThumbnail && Storage::disk('public')->exists('prs/thumbnail/' . $this->oldThumbnail)) {
                    Storage::disk('public')->delete('prs/thumbnail/' . $this->oldThumbnail);
                }
                $thumbnailName = uniqid() . '.' . $this->thumbnail->getClientOriginalExtension();
                $this->thumbnail->storeAs('prs/thumbnail', $thumbnailName, 'public');
            }

            ProdukStatistik::updateOrCreate(
                ['id' => $this->editId],
                [
                    'title'        => $this->title,
                    'slug'         => Str::slug($this->title),
                    'description'  => $this->description,
                    'document'     => $documentName,
                    'thumbnail'    => $thumbnailName,
                    'isbn'         => $this->isbn,
                    'nomor_katalog' => $this->no_katalog,
                    'tanggal_rilis' => $this->tanggal_rilis,
                    'is_active'    => $this->status,
                    'published_at' => $this->publishedAt ?? now(),
                    'user_id'      => auth()->id(),
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
            $data = ProdukStatistik::findOrFail($id);

            if ($data->document && Storage::disk('public')->exists('prs/' . $data->document)) {
                Storage::disk('public')->delete('prs/' . $data->document);
            }
            if ($data->thumbnail && Storage::disk('public')->exists('prs/thumbnail/' . $data->thumbnail)) {
                Storage::disk('public')->delete('prs/thumbnail/' . $data->thumbnail);
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
        return view('livewire.prs-component');
    }
}
