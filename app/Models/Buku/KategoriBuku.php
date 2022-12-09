<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kategori', 'nama_kategori'];

    public function namaKategori(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori');
    }
}
