<?php

namespace App\Models\Transaksi;

use App\Models\Buku\Buku;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeminjamanBuku extends Model
{
    use HasFactory;

    protected $fillable = ['buku_id', 'nama_siswa', 'tgl_pinjam', 'tgl_kembali', 'status', 'denda'];

    public function getJudul(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
