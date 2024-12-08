<!-- resources/views/admin/job_vacancies/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Pekerjaan Baru</h2>

    <form action="{{ route('admin.job_vacancies.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold">Pekerjaan</label>
            <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="id_position" class="block text-gray-700 font-semibold">Posisi</label>
            <select name="id_position" id="id_position" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                <option value="" disabled selected>Pilih Posisi</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->title }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="id_location" class="block text-gray-700 font-semibold">Lokasi</label>
            <select name="id_location" id="id_location" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                <option value="" disabled selected>Pilih Lokasi</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="id_department" class="block text-gray-700 font-semibold">Departemen</label>
            <select name="id_department" id="id_department" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                <option value="" disabled selected>Pilih Departemen</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="requirement" class="block text-gray-700 font-semibold">Requirement</label>
            <textarea name="requirement" id="requirement" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Deskripsi</label>
            <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="benefit" class="block text-gray-700 font-semibold">Benefit</label>
            <textarea name="benefit" id="benefit" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="available_from_date" class="block text-gray-700 font-semibold">Tanggal Buka</label>
            <input type="date" name="available_from_date" id="available_from_date" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="available_to_date" class="block text-gray-700 font-semibold">Tanggal Tutup</label>
            <input type="date" name="available_to_date" id="available_to_date" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        <div class="mb-4">
            <label for="kebutuhan" class="block text-gray-700 font-semibold">Kuota:</label>
            <input type="number" name="kebutuhan" id="kebutuhan" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5" required></textarea>
        </div>
        {{-- <div class="mb-4">
            <label for="is_active" class="block text-gray-700 font-semibold">Status Pekerjaan</label>
            <select name="is_active" id="is_active" class="w-full p-2 border border-gray-300 rounded mt-2">
                <option value="1">Dibuka</option>
                <option value="0">Ditutup</option>
            </select>
        </div> --}}

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
