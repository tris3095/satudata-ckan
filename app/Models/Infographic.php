<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Infographic extends Model
{
    protected $fillable = [
        'title',
        'image',
        'source',
        'is_active',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default.png');;
        }

        if (!Storage::disk('public')->exists('infographics/' . $this->image)) {
            return asset('images/default.png');
        }

        return asset('storage/infographics/' . $this->image);
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Tidak Aktif';
    }
}
