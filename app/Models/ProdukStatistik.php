<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProdukStatistik extends Model
{
    protected $table = 'produk_statistiks';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'document',
        'thumbnail',
        'isbn',
        'nomor_katalog',
        'frekuensi_terbit',
        'tanggal_rilis',
        'bahasa',
        'size',
        'published_at',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'published_at' => 'date',
        'tanggal_rilis' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail || !Storage::disk('public')->exists('prs/thumbnail/' . $this->thumbnail)) {
            return asset('images/default.png');
        }

        return asset('storage/prs/thumbnail/' . $this->thumbnail);
    }

    public function getDocumentUrlAttribute()
    {
        if (!$this->document || !Storage::disk('public')->exists('prs/' . $this->document)) {
            return null;
        }

        return asset('storage/prs/' . $this->document);
    }
}
