<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePencairanRequest extends FormRequest
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
            'invoice' => 'required|file|image|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'invoice.required' => 'Bukti transfer harus diisi',
            'invoice.file' => 'Bukti transfer harus berupa file',
            'invoice.image' => 'Bukti transfer harus berupa gambar',
            'invoice.max' => 'Bukti transfer harus max 4MB',
        ];
    }
}
