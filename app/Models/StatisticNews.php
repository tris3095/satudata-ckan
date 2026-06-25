<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticNews extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image_path',
        'description',
        'materi',
        'size',
        'rilis_date',
        'is_active',
        'user_id',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
