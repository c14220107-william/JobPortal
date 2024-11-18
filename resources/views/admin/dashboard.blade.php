<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
        <p class="text-gray-700 mb-6">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span></p>

        <h3 class="text-xl font-semibold mb-4">Menu</h3>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.job_vacancies.index') }}" class="block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Kelola Pekerjaan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.applications.index') }}" class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                    Lihat Lamaran
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
