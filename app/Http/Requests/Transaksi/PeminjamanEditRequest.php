<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'buku_id' => 'required',
            'nama_siswa' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required|date|after:today',
        ];
    }

    /**
     * Validation custom message.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            // 'buku_id.required'     => '*judul wajib diisi !',
            'nama_siswa.required'  => '*Nama wajib diisi !.',
            'tgl_pinjam.required'  => '*Tanggal Peminjaman wajib diisi !',
            'tgl_kembali.required' => '*Tanggal kembali wajib diisi !',
            'tgl_kembali.after'    => '* Tanggal Pengembalian harus lebih lama dari hari ini !',
        ];
    }
}
