<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveiJawaban extends Model
{
    protected $fillable = [
        'jawaban',
        'ip_address',
    ];

    protected $casts = [
        'jawaban' => 'array',
    ];
}
