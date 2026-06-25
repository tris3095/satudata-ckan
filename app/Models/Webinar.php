<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Webinar extends Model
{
    protected $fillable = [
        'title',
        'image_path',
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
        if (!$this->image_path) {
            return asset('images/default.png');;
        }

        if (!Storage::disk('public')->exists('webinar/' . $this->image_path)) {
            return asset('images/default.png');
        }

        return asset('storage/webinar/' . $this->image_path);
    }

    public function getPeriodeActiveAttribute()
    {
        $now   = Carbon::now();
        $start = Carbon::parse($this->start_date)->startOfDay();
        $end   = Carbon::parse($this->end_date)->endOfDay();

        return $now->between($start, $end);
    }

    public function getPeriodeColorAttribute()
    {
        if ($this->is_active == 1) {
            return 'text-dark';
        }

        return $this->periode_active ? 'text-green-700' : 'text-red-700';
    }

    public function getPeriodeDisplayAttribute()
    {
        if ($this->is_active == 1) {
            return [
                'periode' => 'Tidak terbatas',
                'status'  => '',
            ];
        }

        $now   = Carbon::now();
        $start = Carbon::parse($this->start_date)->startOfDay();
        $end   = Carbon::parse($this->end_date)->endOfDay();

        $periode = $start->translatedFormat('d F Y')
            . ' - ' .
            $end->translatedFormat('d F Y');

        if ($now->between($start, $end)) {
            return [
                'periode' => $periode,
                'status'  => 'Masa tayang aktif',
            ];
        }

        return [
            'periode' => $periode,
            'status'  => 'Masa tayang berakhir',
        ];
    }

    public function getStatusAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Sesuai Periode';
    }
}
