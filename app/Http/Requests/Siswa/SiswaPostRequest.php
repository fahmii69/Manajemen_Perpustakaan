<?php

namespace App\Http\Requests\Siswa;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiswaPostRequest extends FormRequest
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
            'nisn' => ['required', Rule::unique(Siswa::class, 'nisn')],
            'nama' => 'required',
            'kelas' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
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
            'nisn.required'          => '*NISN wajib diisi !',
            'nama.required'          => '*Nama wajib diisi !.',
            'alamat.required'        => '*Alamat wajib diisi !',
            'kelas.required'         => '*Kelas wajib diisi !',
            'tgl_lahir.required'     => '*Tanggal Lahir wajib diisi !',
            'jenis_kelamin.required' => '*Jenis kelamin wajib diisi !',
        ];
    }
}
