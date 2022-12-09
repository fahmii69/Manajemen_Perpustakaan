<?php

namespace App\Http\Requests\Buku\Kategori;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriPostRequest extends FormRequest
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
            'kode_kategori' => ['required', Rule::unique('kategori_bukus', 'kode_kategori')],
            'nama_kategori' => 'required',
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
            'kode_kategori.required' => '*Kode Kategori Buku wajib diisi !',
            'nama_kategori.required' => '*Nama Kategori Buku wajib diisi !.',
        ];
    }
}
