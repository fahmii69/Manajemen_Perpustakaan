<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanPostRequest extends FormRequest
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
            'buku_id' => 'required',
            'nama_siswa' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
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
            'buku_id.required'       => '*judul wajib diisi !',
            'nama_siswa.required'  => '*Nama wajib diisi !.',
            'tgl_pinjam.required'  => '*tgl_pinjam wajib diisi !',
            'tgl_kembali.required' => '*tgl_kembali wajib diisi !',
        ];
    }
}
