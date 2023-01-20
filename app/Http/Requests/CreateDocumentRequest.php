<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
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
            'ipk' => 'required|file|mimes:pdf|max:10240',
            'organization' => 'nullable|file|mimes:pdf|max:10240',
            'achievement' => 'nullable|file|mimes:pdf|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'ipk.required' => 'Dokumen IPK harus dilampirkan',
            'ipk.file' => 'Dokumen IPK harus berupa file',
            'ipk.mimes' => 'Dokumen IPK harus berupa PDF',
            'ipk.max' => 'Dokumen IPK harus max 10MB',
            'organization.file' => 'Dokumen Organisasi harus berupa file',
            'organization.mimes' => 'Dokumen Organisasi harus berupa PDF',
            'organization.max' => 'Dokumen Organisasi harus max 10MB',
            'achievement.file' => 'Dokumen Prestasi harus berupa file',
            'achievement.mimes' => 'Dokumen Prestasi harus berupa PDF',
            'achievement.max' => 'Dokumen Prestasi harus max 10MB',
        ];
    }
}
