<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'id_company' => 'nullable|integer',
            'id_position' => 'required|exists:positions,id',
            'id_location' => 'required|exists:locations,id',
            'id_department' => 'required|exists:departments,id',
            'requirement' => 'required|string',
            'description' => 'required|string',
            'benefit' => 'required|string',
            'additional_info' => 'nullable|string',
            'available_from_date' => 'required|date',
            'available_to_date' => 'required|date|after:available_from_date',
            'is_active' => 'boolean',
            'kebutuhan' => 'required|integer|min:1',
            'count' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul lowongan wajib diisi',
            'title.max' => 'Judul tidak boleh lebih dari 255 karakter',
            'id_position.required' => 'Posisi wajib dipilih',
            'id_position.exists' => 'Posisi yang dipilih tidak valid',
            'id_location.required' => 'Lokasi wajib dipilih',
            'id_location.exists' => 'Lokasi yang dipilih tidak valid',
            'id_department.required' => 'Departemen wajib dipilih',
            'id_department.exists' => 'Departemen yang dipilih tidak valid',
            'requirement.required' => 'Persyaratan wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'benefit.required' => 'Benefit wajib diisi',
            'available_from_date.required' => 'Tanggal mulai wajib diisi',
            'available_from_date.date' => 'Format tanggal mulai tidak valid',
            'available_to_date.required' => 'Tanggal berakhir wajib diisi',
            'available_to_date.date' => 'Format tanggal berakhir tidak valid',
            'available_to_date.after' => 'Tanggal berakhir harus setelah tanggal mulai',
            'kebutuhan.required' => 'Jumlah kebutuhan wajib diisi',
            'kebutuhan.integer' => 'Jumlah kebutuhan harus berupa angka',
            'kebutuhan.min' => 'Jumlah kebutuhan minimal 1'
        ];
    }
} 