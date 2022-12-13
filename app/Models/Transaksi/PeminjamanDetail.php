<?php

namespace App\Models\Transaksi;

use App\Models\Buku\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = "peminjaman_details";

    public $appends = [
        'judul_buku'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanBuku::class, 'peminjaman_id');
    }

    public function getJudulBukuAttribute()
    {
        return $this->buku->judul;
    }
}
