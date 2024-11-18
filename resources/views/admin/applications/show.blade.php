@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Detail Aplikasi</h1>

        <div class="mb-4">
            <p><strong>Nama Pelamar:</strong> {{ $application->user->name }}</p>
            <p><strong>Email:</strong> {{ $application->user->email }}</p>
            <p><strong>Judul Pekerjaan:</strong> {{ $application->jobVacancy->title }}</p>
            <p><strong>Waktu Melamar:</strong> {{ $application->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="mb-4">
            <p><strong>Cover Letter:</strong></p>
            <p class="border-l-4 border-blue-500 pl-4 text-gray-700">{{ $application->cover_letter }}</p>
        </div>

        <a href="{{ route('admin.applications.index') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Kembali ke Daftar Aplikasi
        </a>
    </div>
</div>
@endsection
        