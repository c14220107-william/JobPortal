@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-wide">Detail Lowongan</h2>
                <p class="text-gray-600 mt-2">Informasi lengkap tentang lowongan pekerjaan</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.job_vacancies.edit', $jobVacancy->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-400 transition duration-200 shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Lowongan
                </a>
                <a href="{{ route('admin.job_vacancies.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-200 shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Status Section -->
        <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $jobVacancy->status['class'] }}">
                        {{ $jobVacancy->status['text'] }}
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ $jobVacancy->applications->count() }}/{{ $jobVacancy->kebutuhan }} Pelamar
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    Periode: {{ \Carbon\Carbon::parse($jobVacancy->available_from_date)->format('d M Y') }} - 
                    {{ \Carbon\Carbon::parse($jobVacancy->available_to_date)->format('d M Y') }}
                </div>
            </div>
        </div>

        <!-- Basic Info Section -->
        <div class="px-6 py-6 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Posisi</h3>
                    <p class="mt-1 text-lg text-gray-900">{{ $jobVacancy->position->title }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Lokasi</h3>
                    <p class="mt-1 text-lg text-gray-900">{{ $jobVacancy->location->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Departemen</h3>
                    <p class="mt-1 text-lg text-gray-900">{{ $jobVacancy->department->name }}</p>
                </div>
            </div>
        </div>

        <!-- Job Details Section -->
        <div class="px-6 py-6 space-y-6">
            <!-- Description -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi Pekerjaan</h3>
                <div class="prose max-w-none text-gray-900">
                    {!! nl2br(e($jobVacancy->description)) !!}
                </div>
            </div>

            <!-- Requirements -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Persyaratan</h3>
                <div class="prose max-w-none text-gray-900">
                    {!! nl2br(e($jobVacancy->requirement)) !!}
                </div>
            </div>

            <!-- Benefits -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Benefit</h3>
                <div class="prose max-w-none text-gray-900">
                    {!! nl2br(e($jobVacancy->benefit)) !!}
                </div>
            </div>

            @if($jobVacancy->additional_info)
            <!-- Additional Info -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Informasi Tambahan</h3>
                <div class="prose max-w-none text-gray-900">
                    {!! nl2br(e($jobVacancy->additional_info)) !!}
                </div>
            </div>
            @endif
        </div>

        <!-- Applicants Section -->
        <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900">Daftar Pelamar</h3>
            <div class="mt-4">
                @if($jobVacancy->applications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Melamar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jobVacancy->applications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $application->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $application->user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($application->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Belum ada pelamar untuk lowongan ini.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
