<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileOperatorUpdateRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'picture' => 'nullable|file|image|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'address.required' => 'Alamat harus diisi',
            'picture.file' => 'Gambar harus berupa file',
            'picture.image' => 'Gambar harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'picture.max' => 'Gambar maksimal 4MB'
        ];
    }
}
