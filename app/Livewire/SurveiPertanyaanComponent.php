<?php

namespace App\Livewire;

use App\Models\SurveiPertanyaan;
use Livewire\Component;

class SurveiPertanyaanComponent extends Component
{
    public $titlePage;
    public $kode, $pertanyaan, $tipe = 'skala', $urutan, $is_conditional = false, $is_required = true, $is_active = true;
    public $showModal = false;
    public $editId = null;

    protected $listeners = ['delete'];

    protected $rules = [
        'kode'           => 'nullable|string|max:5',
        'pertanyaan'     => 'required|string',
        'tipe'           => 'required|in:skala,ya_tidak,teks',
        'urutan'         => 'required|integer|min:0',
        'is_conditional' => 'boolean',
        'is_required'    => 'boolean',
        'is_active'      => 'boolean',
    ];

    protected $messages = [
        'pertanyaan.required' => 'Pertanyaan wajib diisi',
        'tipe.required'       => 'Tipe pertanyaan wajib dipilih',
        'urutan.required'     => 'Urutan wajib diisi',
        'urutan.integer'      => 'Urutan harus berupa angka',
    ];

    public function getDatasProperty()
    {
        return SurveiPertanyaan::urut()->get();
    }

    public function updated($propertyName)
    {
        $this->resetValidation($propertyName);
    }

    public function openModal()
    {
        $this->reset(['kode', 'pertanyaan', 'urutan', 'is_conditional', 'is_required', 'is_active', 'editId']);
        $this->tipe = 'skala';
        $this->is_required = true;
        $this->is_active = true;
        $this->urutan = (int) (SurveiPertanyaan::max('urutan') + 1);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $data = SurveiPertanyaan::findOrFail($id);

        $this->editId         = $id;
        $this->kode           = $data->kode;
        $this->pertanyaan     = $data->pertanyaan;
        $this->tipe           = $data->tipe;
        $this->urutan         = $data->urutan;
        $this->is_conditional = $data->is_conditional;
        $this->is_required    = $data->is_required;
        $this->is_active      = $data->is_active;

        $this->resetValidation();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        try {
            SurveiPertanyaan::updateOrCreate(
                ['id' => $this->editId],
                [
                    'kode'           => $this->kode,
                    'pertanyaan'     => $this->pertanyaan,
                    'tipe'           => $this->tipe,
                    'urutan'         => $this->urutan,
                    'is_conditional' => $this->is_conditional,
                    'is_required'    => $this->is_required,
                    'is_active'      => $this->is_active,
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
            'id'    => $id,
            'title' => 'Apakah kamu yakin?',
            'text'  => 'Data pertanyaan ini akan dihapus permanen!',
            'icon'  => 'warning',
        ]);
    }

    public function delete($id)
    {
        try {
            SurveiPertanyaan::findOrFail($id)->delete();

            $this->notify('success', 'Data berhasil dihapus');
        } catch (\Throwable $e) {
            $this->notify('error', 'Gagal menghapus data');
        }
    }

    private function notify($type, $message)
    {
        $this->dispatch('notify', [
            'type'    => $type,
            'message' => $message,
        ]);
    }

    public function render()
    {
        return view('livewire.survei-pertanyaan-component');
    }
}
