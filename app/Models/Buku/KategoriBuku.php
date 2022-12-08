<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kategori','nama_kategori'];
    
    public function namaKategori()
    {
        return $this->hasMany(Buku::class,'kategori');
    }
}

