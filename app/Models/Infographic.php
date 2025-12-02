<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Infographic extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'source',
        'published_at',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return '/default-infografis.png';
        }

        return asset('storage/infographic/' . $this->image);
    }
}
