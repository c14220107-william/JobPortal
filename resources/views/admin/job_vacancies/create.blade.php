<!-- resources/views/admin/job_vacancies/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Pekerjaan Baru</h2>

    <form action="{{ route('admin.job_vacancies.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold">Judul Pekerjaan</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-semibold">Lokasi</label>
            <input type="text" name="location" id="location" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="department" class="block text-gray-700 font-semibold">Departemen</label>
            <input type="text" name="department" id="department" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Deskripsi</label>
            <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="is_open" class="block text-gray-700 font-semibold">Status Pekerjaan</label>
            <select name="is_open" id="is_open" class="w-full p-2 border border-gray-300 rounded mt-2">
                <option value="1">Dibuka</option>
                <option value="0">Ditutup</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
