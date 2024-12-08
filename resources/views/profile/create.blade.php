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
            <label for="tempat_lahir" class="block text-gray-700 font-semibold">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="w-full p-2 border border-gray-300 rounded mt-2" required>
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
            <label for="jenjang_pendidikan" class="block text-gray-700 font-semibold">Jenjang Pendidikan</label>
            <select id="jenjang_pendidikan" name="jenjang_pendidikan" class="w-full p-2 border border-gray-300 p-2 rounded" required>
                <option value="" disabled selected>Pilih Jenjang</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="D3">D3</option>
                <option value="D4">D2</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="asal_universitas" class="block text-gray-700 font-semibold">Asal Universitas</label>
            <input type="text" name="asal_universitas" id="asal_universitas" class="w-full p-2 border border-gray-300 rounded mt-2" >
        </div>
        <div class="mb-4">
            <label for="pekerjaan_terakhir" class="block text-gray-700 font-semibold">Pekerjaan Terakhir</label>
            <input type="text" name="pekerjaan_terakhir" id="pekerjaan_terakhir" class="w-full p-2 border border-gray-300 rounded mt-2" >
        </div>
        <div class="mb-4">
            <label for="total_lama_bekerja" class="block text-gray-700 font-semibold">Total Lama Bekerja</label>
            <input type="text" name="total_lama_bekerja" id="total_lama_bekerja" class="w-full p-2 border border-gray-300 rounded mt-2">
        </div>
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700 font-semibold">Foto</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full p-2 border border-gray-300 rounded mt-2" accept="image/*">
        </div>
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 font-semibold">Bio</label>
            <textarea name="bio" id="bio" class="w-full p-2 border border-gray-300 rounded mt-2" rows="5"></textarea>
        </div>
        <div class="mb-4">
            <label for="resume_link" class="block text-gray-700 font-semibold">Resume (PDF ONLY)</label>
            <input type="file" name="resume_link" id="resume_link" class="w-full p-2 border border-gray-300 rounded mt-2" accept=".pdf">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Simpan</button>
    </form>
</div>
@endsection
