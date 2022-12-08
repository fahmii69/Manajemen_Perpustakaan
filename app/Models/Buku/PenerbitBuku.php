<?php

namespace App\Models\Buku;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerbitBuku extends Model
{
    use HasFactory;

    protected $fillable = [ 'kode_penerbit','nama_penerbit'];

    public function namaPenerbit()
    {
        return $this->hasMany(Buku::class,'penerbit');
    }
}
