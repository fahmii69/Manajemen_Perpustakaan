<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function namaKategori()
    {
        return $this->belongsTo(KategoriBuku::class,'kategori');
    }

    public function namaPenerbit()
    {
        return $this->belongsTo(PenerbitBuku::class,'penerbit');
    }

}
