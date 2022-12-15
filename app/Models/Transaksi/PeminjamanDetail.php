<?php

namespace App\Models\Transaksi;

use App\Models\Buku\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = "peminjaman_details";
    protected $fillable = ['buku_id', 'peminjaman_id', 'status'];

    public $appends = [
        'judul_buku'
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(PeminjamanBuku::class, 'peminjaman_id');
    }

    public function getJudulBukuAttribute()
    {
        return $this->buku->judul;
    }
}
