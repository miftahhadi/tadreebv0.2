<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => '',
            'gender' => '',
            'tanggal_lahir' => ''
        ];
    }

    public function messages() {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username ini sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email ini sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong'
        ];
    }
}
