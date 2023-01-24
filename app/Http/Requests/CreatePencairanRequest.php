<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'status' => ['required', Rule::in(['belum transfer', 'sudah transfer'])],
            'dana' => 'required|numeric',
            'spp' => 'required|numeric',
            'received_funds' => 'required|numeric',
            'catatan' => 'nullable',
            'invoice' => 'nullable|file|image|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'invoice.file' => 'Bukti transfer harus berupa file',
            'invoice.image' => 'Bukti transfer harus berupa gambar',
            'invoice.max' => 'Bukti transfer harus max 4MB',
            'status.required' => 'Status harus diisi',
            'dana.required' => 'Dana BCB harus diisi',
            'spp.required' => 'SPP harus diisi',
            'received_funds.required' => 'Dana Diterima harus diisi',
            'dana.numeric' => 'Dana BCB harus angka',
            'received_funds.numeric' => 'Dana Diterima harus angka',
            'spp.numeric' => 'SPP harus angka',
            'status.in' => 'Status harus belum transfer atau sudah transfer',
        ];
    }
}
