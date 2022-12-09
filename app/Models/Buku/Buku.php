<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'pengarang',
        'tahun_terbit',
        'isbn',
        'jumlah_buku',
        'rak_buku',
    ];

    public function namaKategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'kategori');
    }

    public function namaPenerbit(): BelongsTo
    {
        return $this->belongsTo(PenerbitBuku::class, 'penerbit');
    }
}
