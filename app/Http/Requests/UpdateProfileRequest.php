<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // max 2MB
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'tempat_lahir' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string'],
            'jenjang_pendidikan' => ['nullable', 'string', 'max:255'],
            'asal_universitas' => ['nullable', 'string', 'max:255'],
            'pekerjaan_terakhir' => ['nullable', 'string', 'max:255'],
            'total_lama_bekerja' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'profile_picture' => 'Foto Profil',
            'nomor_telepon' => 'Nomor Telepon',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'jenjang_pendidikan' => 'Jenjang Pendidikan',
            'asal_universitas' => 'Asal Universitas',
            'pekerjaan_terakhir' => 'Pekerjaan Terakhir',
            'total_lama_bekerja' => 'Total Lama Bekerja',
            'bio' => 'Biografi',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            
            'email.required' => 'Alamat email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain',
            
            'profile_picture.image' => 'File harus berupa gambar (JPG, JPEG, PNG, BMP, GIF, SVG, atau WEBP)',
            'profile_picture.max' => 'Ukuran foto profil tidak boleh lebih dari 2MB',
            
            'nomor_telepon.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter',
            
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter',
            
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            
            'jenjang_pendidikan.max' => 'Jenjang pendidikan tidak boleh lebih dari 255 karakter',
            
            'asal_universitas.max' => 'Asal universitas tidak boleh lebih dari 255 karakter',
            
            'pekerjaan_terakhir.max' => 'Pekerjaan terakhir tidak boleh lebih dari 255 karakter',
            
            'total_lama_bekerja.max' => 'Total lama bekerja tidak boleh lebih dari 255 karakter',
        ];
    }
} 