<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required|unique:groups,nama',
            'deskripsi' => 'max:600'
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Nama grup tidak boleh kosong.',
            'judul.unique' => 'Nama grup ini sudah ada. Pilih nama lain.',
            'deskripsi.max' => 'Deskripsi paling banyak memuat 600 karakter.'
        ];
    }
}
