@extends('layouts.app')

@section('content')
<div class="p-16">
    <div class="p-8 bg-white shadow mt-24">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                <!-- Kolom statistik (opsional) -->
            </div>
            <div class="relative">
                <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500 mb-4">
                    <img src="{{ Storage::disk('s3')->url($user->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full">
                </div>
            </div>
        </div>
        <div class="mt-20 text-center border-b pb-12">
          <h1 class="text-4xl font-medium text-gray-700 mt-6">{{ $user->name }}</h1>
          
          <p class="mt-2 text-gray-500">{{ $user->asal_universitas ?? 'Universitas tidak diketahui' }}</p>
      </div>
      
        <div class="mt-12">
            <h3 class="text-lg font-medium text-gray-700">Detail Profil</h3>
            <div class="mt-4 text-gray-600">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Nomor Telepon:</strong> {{ $user->nomor_telepon ?? 'Belum diisi' }}</p>
                <p><strong>Tempat Lahir:</strong> {{ $user->tempat_lahir ?? 'Belum diisi' }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d M Y') : 'Belum diisi' }}</p>
                <p><strong>Jenjang Pendidikan:</strong> {{ $user->jenjang_pendidikan ?? 'Belum diisi' }}</p>
                <p><strong>Total Lama Bekerja:</strong> {{ $user->total_lama_bekerja ?? 'Belum diisi' }}</p>
            </div>
        </div>
        <div class="mt-12">
            <h3 class="text-lg font-medium text-gray-700">Tentang Saya</h3>
            <p class="text-gray-600 mt-4">{{ $user->bio ?? 'Deskripsi belum tersedia.' }}</p>
        </div>
        <div class="mt-12">
            <h3 class="text-lg font-medium text-gray-700">Resume</h3>
            @if($user->resume_link)
                <a href="{{  Storage::disk('s3')->url($user->resume_link)  }}" target="_blank" class="text-blue-500 hover:underline">Lihat Resume</a>
            @else
                <p class="text-gray-600">Resume belum diunggah.</p>
            @endif
        </div>
    </div>
</div>
@endsection
