<?php

namespace App\Http\Requests\Buku\Penerbit;

use App\Models\Buku\PenerbitBuku;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenerbitPostRequest extends FormRequest
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
            'kode_penerbit' => ['required', Rule::unique('penerbit_bukus', 'kode_penerbit')],
            'nama_penerbit' => 'required',
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
            'kode_penerbit.required' => '*Kode Penerbit Buku wajib diisi !',
            'nama_penerbit.required' => '*Nama Penerbit Buku wajib diisi !.',
        ];
    }
}
