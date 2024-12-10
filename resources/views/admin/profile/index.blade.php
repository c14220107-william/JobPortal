@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-wide">Profil Admin</h2>
                <p class="text-gray-600 mt-2">Kelola informasi profil Anda</p>
            </div>
            <a href="{{ route('admin.profile.edit') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profil
            </a>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Profile Header -->
        <div class="relative h-48 bg-green-600">
            <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2">
                <div class="w-40 h-40 rounded-full border-4 border-white overflow-hidden bg-white shadow-lg">
                    @if($admin->profile_picture)
                        <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Info -->
        <div class="pt-24 px-6 pb-6">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">{{ ucwords(strtolower($admin->name)) }}</h3>
                <p class="text-gray-600 mt-1">{{ $admin->email }}</p>
                <p class="text-green-600 font-medium mt-1">Administrator</p>
            </div>

            <!-- Profile Details -->
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                                <p class="mt-1 text-gray-900">{{ $admin->nomor_telepon ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tempat Lahir</label>
                                <p class="mt-1 text-gray-900">{{ $admin->tempat_lahir ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tanggal Lahir</label>
                                <p class="mt-1 text-gray-900">
                                    {{ $admin->tanggal_lahir ? \Carbon\Carbon::parse($admin->tanggal_lahir)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Alamat</label>
                                <p class="mt-1 text-gray-900">{{ $admin->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Profesional</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Jenjang Pendidikan</label>
                                <p class="mt-1 text-gray-900">{{ $admin->jenjang_pendidikan ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Asal Universitas</label>
                                <p class="mt-1 text-gray-900">{{ $admin->asal_universitas ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Pekerjaan Terakhir</label>
                                <p class="mt-1 text-gray-900">{{ $admin->pekerjaan_terakhir ?? '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Total Lama Bekerja</label>
                                <p class="mt-1 text-gray-900">{{ $admin->total_lama_bekerja ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($admin->bio)
                <!-- Bio -->
                <div class="mt-6 bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Biografi</h4>
                    <p class="text-gray-700">{{ $admin->bio }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection