<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreExamRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug)
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul' => 'required',
            'slug' => ['required','unique:exams'],
            'deskripsi' => ''
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul tidak boleh kosong',
            'slug.required' => 'Slug URL tidak boleh kosong',
            'slug.unique' => 'Slug URL ini sudah ada, coba yang lain'
        ];
    }
}
