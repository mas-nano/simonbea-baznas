<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Nama harus diisi',
            'email.required'=>'Email harus diisi',
            'email.email'=>'Email tidak valid',
            'email.unique'=>'Email sudah digunakan',
            'password.required'=>'Password harus diisi',
            'password.confirmed'=>'Password tidak sama dengan konfirmasi password',
            'password_confirmation.required'=>'Konfirmasi Password harus diisi'
        ];
    }
}
