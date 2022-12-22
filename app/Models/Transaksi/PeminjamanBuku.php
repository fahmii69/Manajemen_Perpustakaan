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

    protected $fillable = ['nama_siswa', 'tgl_pinjam', 'tgl_kembali', 'status', 'hilang'];

    public function getDetail(): HasMany
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }

    public function userId(): BelongsTo
    {
        return $this->belongsTo(User::class . 'user_id');
    }
}
