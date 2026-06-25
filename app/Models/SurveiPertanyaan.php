<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveiPertanyaan extends Model
{
    protected $fillable = [
        'kode',
        'pertanyaan',
        'tipe',
        'urutan',
        'is_conditional',
        'is_required',
        'is_active',
    ];

    protected $casts = [
        'is_conditional' => 'boolean',
        'is_required'    => 'boolean',
        'is_active'      => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function getTipeLabelAttribute()
    {
        return match ($this->tipe) {
            'skala'    => 'Skala 1-5',
            'ya_tidak' => 'Ya / Tidak',
            'teks'     => 'Teks Bebas',
            default    => $this->tipe,
        };
    }
}
