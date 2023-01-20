<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAwardeeRequest extends FormRequest
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
            'nim' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required|numeric',
            'level' => 'required',
            'status' => ['required', Rule::in(['aktif', 'nonaktif', 'pending'])],
            'gen' => 'required|numeric',
            'account_number' => 'required|numeric',
            'bank' => 'required',
            'parent_name' => 'required',
            'parent_salary' => 'required|numeric',
            'parent_phone' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'nim.required' => 'NIM harus diisi',
            'nim.numeric' => 'NIM harus berupa angka',
            'gen.numeric' => 'Angkatan harus berupa angka',
            'phone.numeric' => 'Nomor Telepon harus berupa angka',
            'account_number.numeric' => 'Nomor Rekening harus berupa angka',
            'parent_salary.numeric' => 'Penghasilan Orang Tua harus berupa angka',
            'parent_phone.numeric' => 'Nomor Telepon Orang Tua harus berupa angka',
            'address.required' => 'Alamat harus diisi',
            'phone.required' => 'Nomor Telepon harus diisi',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus berisi aktif, nonaktif atau pending',
            'gen.required' => 'Angkatan harus diisi',
            'level.required' => 'Semester harus diisi',
            'account_number.required' => 'Nomor Rekening harus diisi',
            'bank.required' => 'Bank harus diisi',
            'parent_name.required' => 'Nama Orang Tua harus diisi',
            'parent_salary.required' => 'Penghasilan Orang Tua harus diisi',
            'parent_salary.numeric' => 'Penghasilan Orang Tua harus berupa angka',
            'parent_phone.required' => 'Nomor Telepon Orang Tua harus diisi',
            'parent_phone.numeric' => 'Nomor Telepon Orang Tua harus berupa angka',
        ];
    }
}
