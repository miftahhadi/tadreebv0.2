<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'nama' => 'required',
            'deskripsi' => 'max:600'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama kelas tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi kelas maksimal 600 karakter'
        ];
    }
}
