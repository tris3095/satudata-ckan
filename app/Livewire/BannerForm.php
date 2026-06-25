<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;

class BannerForm extends Component
{
    public $showModal = false;
    public $title;
    public $file;
    public $is_active = 1;

    public function openModal()
    {
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        // validasi
        $this->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|image|max:2048',
            'is_active' => 'required|boolean',
        ]);

        // simpan ke database (contoh)
        Banner::create([
            'title' => $this->title,
            'is_active' => $this->is_active,
            'file' => $this->file ? $this->file->store('banners') : null,
        ]);

        $this->closeModal();
        session()->flash('success', 'Data berhasil disimpan');
    }

    public function render()
    {
        return view('livewire.banner-form');
    }
}
