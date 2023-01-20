<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileAwardeeUpdateRequest extends FormRequest
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
            'gen' => 'required|numeric',
            'account_number' => 'required|numeric',
            'bank' => 'required',
            'front_home' => 'nullable|file|image|max:4096',
            'back_home' => 'nullable|file|image|max:4096',
            'side_home' => 'nullable|file|image|max:4096',
            'register_proof' => 'nullable|file|image|max:4096',
            'picture' => 'nullable|file|image|max:4096',
            'surat_ket_tidak_mampu' => 'nullable|file|mimes:pdf|max:10240',
            'certificates' => 'nullable|file|mimes:pdf|max:10240',
            'identity' => 'nullable|file|mimes:pdf|max:10240',
            'cv' => 'nullable|file|mimes:pdf|max:10240',
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
            'gen.required' => 'Angkatan harus diisi',
            'level.required' => 'Semester harus diisi',
            'account_number.required' => 'Nomor Rekening harus diisi',
            'bank.required' => 'Bank harus diisi',
            'front_home.file' => 'Rumah Tampak Depan harus berupa file',
            'front_home.image' => 'Rumah Tampak Depan harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'front_home.max' => 'Rumah Tampak Depan max 4MB',
            'side_home.file' => 'Rumah Tampak Samping harus berupa file',
            'side_home.image' => 'Rumah Tampak Samping harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'side_home.max' => 'Rumah Tampak Samping max 4MB',
            'back_home.file' => 'Rumah Tampak Belakang harus berupa file',
            'back_home.image' => 'Rumah Tampak Belakang harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'back_home.max' => 'Rumah Tampak Belakang max 4MB',
            'register_proof.file' => 'Bukti Pendaftaran harus berupa file',
            'register_proof.image' => 'Bukti Pendaftaran harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'register_proof.max' => 'Bukti Pendaftaran max 4MB',
            'picture.file' => 'Foto harus berupa file',
            'picture.image' => 'Foto harus berekstensi jpg, jpeg, png, bmp, gif, svg, atau webp',
            'picture.max' => 'Foto max 4MB',
            'surat_ket_tidak_mampu.file' => 'Surat Keterangan Tidak Mampu harus berupa file',
            'surat_ket_tidak_mampu.mimes' => 'Surat Keterangan Tidak Mampu harus berupa PDF',
            'surat_ket_tidak_mampu.max' => 'Surat Keterangan Tidak Mampu max 10MB',
            'certificates.file' => 'Sertifikat harus berupa file',
            'certificates.mimes' => 'Sertifikat harus berupa PDF',
            'certificates.max' => 'Sertifikat max 10MB',
            'cv.file' => 'Data Mahasiswa harus berupa file',
            'cv.mimes' => 'Data Mahasiswa harus berupa PDF',
            'cv.max' => 'Data Mahasiswa max 10MB',
            'identity.file' => 'Identitas Mahasiswa harus berupa file',
            'identity.mimes' => 'Identitas Mahasiswa harus berupa PDF',
            'identity.max' => 'Identitas Mahasiswa max 10MB',
            'parent_name.required' => 'Nama Orang Tua harus diisi',
            'parent_salary.required' => 'Penghasilan Orang Tua harus diisi',
            'parent_salary.numeric' => 'Penghasilan Orang Tua harus berupa angka',
            'parent_phone.required' => 'Nomor Telepon Orang Tua harus diisi',
            'parent_phone.numeric' => 'Nomor Telepon Orang Tua harus berupa angka',
        ];
    }
}
