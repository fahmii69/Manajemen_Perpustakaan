<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nisn', 'nama', 'tgl_lahir', 'alamat', 'kelas', 'jenis_kelamin'];

    public function getNamaSiswa(): HasMany
    {
        return $this->HasMany(Siswa::class, 'nama_siswa');
    }
}
