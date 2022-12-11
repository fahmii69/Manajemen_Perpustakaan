<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Buku{
/**
 * App\Models\Buku\Buku
 *
 * @property int $id
 * @property string $judul
 * @property string $kategori
 * @property string $penerbit
 * @property string $pengarang
 * @property int $tahun_terbit
 * @property int $isbn
 * @property int $jumlah_buku
 * @property string $rak_buku
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Buku\KategoriBuku|null $namaKategori
 * @property-read \App\Models\Buku\PenerbitBuku|null $namaPenerbit
 * @method static \Database\Factories\Buku\BukuFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Buku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Buku query()
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereJumlahBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku wherePenerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku wherePengarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereRakBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereTahunTerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buku whereUpdatedAt($value)
 */
	class Buku extends \Eloquent {}
}

namespace App\Models\Buku{
/**
 * App\Models\Buku\KategoriBuku
 *
 * @property int $id
 * @property string $kode_kategori
 * @property string $nama_kategori
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Buku\Buku[] $namaKategori
 * @property-read int|null $nama_kategori_count
 * @method static \Database\Factories\Buku\KategoriBukuFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku query()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku whereKodeKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku whereNamaKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBuku whereUpdatedAt($value)
 */
	class KategoriBuku extends \Eloquent {}
}

namespace App\Models\Buku{
/**
 * App\Models\Buku\PenerbitBuku
 *
 * @property int $id
 * @property string $kode_penerbit
 * @property string $nama_penerbit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Buku\Buku[] $namaPenerbit
 * @property-read int|null $nama_penerbit_count
 * @method static \Database\Factories\Buku\PenerbitBukuFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku query()
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku whereKodePenerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku whereNamaPenerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PenerbitBuku whereUpdatedAt($value)
 */
	class PenerbitBuku extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Siswa
 *
 * @property int $id
 * @property int $nisn
 * @property string $nama
 * @property string $tgl_lahir
 * @property string $alamat
 * @property string $kelas
 * @property string $jenis_kelamin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereNisn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereTglLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Siswa whereUpdatedAt($value)
 */
	class Siswa extends \Eloquent {}
}

namespace App\Models\Transaksi{
/**
 * App\Models\Transaksi\PeminjamanBuku
 *
 * @property int $id
 * @property string $judul
 * @property string $nama_siswa
 * @property int $jumlah_buku
 * @property string $tgl_pinjam
 * @property string $tgl_kembali
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Transaksi\PeminjamanBukuFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku query()
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereJumlahBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereNamaSiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereTglKembali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereTglPinjam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PeminjamanBuku whereUpdatedAt($value)
 */
	class PeminjamanBuku extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}
