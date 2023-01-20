<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeriodRequest extends FormRequest
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
            'semester' => ['required', Rule::in(['ganjil', 'genap'])],
            'last_registration' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'semester.required' => 'Semester harus diisi',
            'semester.in' => 'Semester harus ganjil atau genap',
            'last_registration.required' => 'Tanggal Akhir Pendaftaran harus diisi',
            'last_registration.date' => 'Tanggal Akhir Pendaftaran harus berupa tanggal',
        ];
    }
}
