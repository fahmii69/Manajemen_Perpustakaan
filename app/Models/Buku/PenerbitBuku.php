<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenerbitBuku extends Model
{
    use HasFactory;

    protected $table = 'penerbit_bukus';
    protected $fillable = ['kode_penerbit', 'nama_penerbit'];

    public function namaPenerbit(): HasMany
    {
        return $this->hasMany(Buku::class, 'penerbit');
    }
}
