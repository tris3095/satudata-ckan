<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'link_url',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->where('is_active', 1)
                ->orWhere(function ($q2) {
                    $q2->where('is_active', 0)
                        ->whereDate('start_date', '<=', now())
                        ->whereDate('end_date', '>=', now());
                });
        });
    }

    public function getImageUrlAttribute()
    {
        return Storage::url('public/banner/' . $this->image_path);
    }

    public function getPeriodeActiveAttribute()
    {
        $now   = Carbon::now();
        $start = Carbon::parse($this->start_date);
        $end   = Carbon::parse($this->end_date);

        return $now->between($start, $end);
    }

    public function getPeriodeColorAttribute()
    {
        if ($this->is_active == 1) {
            return 'text-dark';
        }

        return $this->periode_active ? 'text-success' : 'text-danger';
    }

    public function getPeriodeDisplayAttribute()
    {
        if ($this->is_active == 1) {
            return 'Tidak terbatas';
        }

        return Carbon::parse($this->start_date)->translatedFormat('d F Y')
            . ' - ' .
            Carbon::parse($this->end_date)->translatedFormat('d F Y');
    }
}
