<!-- resources/views/admin/users/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <h1>Harap Isi Data Terlebih Dahulu untuk Keperluan Melamar</h1>
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $user->name  }}" readonly>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $user->email }}" readonly>
        </div>
        <div class="mb-4">
            <label for="nomor_telepon" class="block text-gray-700 font-semibold">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="tanggal_lahir" class="block text-gray-700 font-semibold">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-semibold">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="total_lama_bekerja" class="block text-gray-700 font-semibold">Total Lama Bekerja</label>
            <input type="text" name="total_lama_bekerja" id="total_lama_bekerja" class="w-full p-2 border border-gray-300 rounded mt-2" required>
        </div>
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700 font-semibold">Foto Profil</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full p-2 border border-gray-300 rounded mt-2" accept="image/*">
        </div>
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 font-semibold">Bio</label>
            <textarea name="bio" id="bio" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5"></textarea>
        </div>
        <div class="mb-4">
            <label for="resume_link" class="block text-gray-700 font-semibold">Resume</label>
            <input type="file" name="resume_link" id="resume_link" class="w-full p-2 border border-gray-300 rounded mt-2" accept=".pdf">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
