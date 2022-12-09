<?php

namespace App\Http\Requests\Buku\Katalog;

use Illuminate\Foundation\Http\FormRequest;

class BukuPostRequest extends FormRequest
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
            'judul'        => 'required',
            'kategori'     => 'required',
            'penerbit'     => 'required',
            'pengarang'    => 'required',
            'tahun_terbit' => 'required',
            'isbn'         => 'required',
            'jumlah_buku'  => 'required',
            'rak_buku'     => 'required',
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
            'judul.required'        => '*Judul Buku wajib diisi !',
            'kategori.required'     => '*Kategori Buku wajib diisi !.',
            'penerbit.required'     => '*Penerbit wajib diisi !',
            'pengarang.required'    => '*Pengarang wajib diisi !',
            'tahun_terbit.required' => '*Tahun Terbit wajib diisi !',
            'isbn.required'         => '*ISBN wajib diisi !',
            'jumlah_buku.required'  => '*Jumlah Buku wajib diisi !',
            'rak_buku.required'     => '*Rak Buku wajib diisi !',
        ];
    }
}
