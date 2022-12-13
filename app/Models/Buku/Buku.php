<?php

namespace App\Models\Buku;

use App\Models\Transaksi\PeminjamanDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'penerbit',
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

    public function getJudul(): HasMany
    {
        return $this->HasMany(PeminjamanDetail::class, 'buku_id');
    }
    public function getBuku(): HasMany
    {
        return $this->HasMany(PeminjamanBuku::class, 'buku_id');
    }
}
