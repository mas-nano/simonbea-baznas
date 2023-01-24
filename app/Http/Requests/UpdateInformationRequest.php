<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
            'title' => 'required',
            'category' => 'required',
            'first_paragraph' => 'required',
            'body' => 'required',
            'thumbnail' => 'nullable|file|image|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul harus diisi',
            'body.required' => 'Isi posting harus diisi',
            'category.required' => 'Kategori harus diisi',
            'first_paragraph.required' => 'Kategori harus diisi',
            'thumbnail.file' => 'Gambar thumbnail harus berupa file',
            'thumbnail.image' => 'Gambar thumbnail harus berupa gambar',
            'thumbnail.max' => 'Gambar thumbnail harus max 4MB',
        ];
    }
}
