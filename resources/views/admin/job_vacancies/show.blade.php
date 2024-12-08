@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Detail Pekerjaan</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="mb-4"><strong>Judul:</strong> {{ $jobVacancy->title }}</p>
        <p class="mb-4"><strong>Posisi:</strong> {{ $jobVacancy->position->title }}</p>
        <p class="mb-4"><strong>Lokasi:</strong> {{ $jobVacancy->location->name }}</p>
        <p class="mb-4"><strong>Departemen:</strong> {{ $jobVacancy->department->name }}</p>
        <p class="mb-4"><strong>Requirement:</strong> {!! nl2br(e($jobVacancy->requirement)) !!}</p>
        <p class="mb-4"><strong>Deskripsi:</strong> {!! nl2br(e($jobVacancy->description)) !!}</p>
        <p class="mb-4"><strong>Benefit:</strong> {!! nl2br(e($jobVacancy->benefit)) !!}</p>
        <p class="mb-4"><strong>Tanggal Buka:</strong> {{ $jobVacancy->available_from_date }}</p>
        <p class="mb-4"><strong>Tanggal Tutup:</strong> {{ $jobVacancy->available_to_date }}</p>
        <p class="mb-4"><strong>Kuota:</strong> {{ $jobVacancy->kebutuhan }}</p>
        <p class="mb-4"><strong>Status:</strong> {{ $jobVacancy->is_active ? 'Dibuka' : 'Ditutup' }}</p>
    </div>

    <a href="{{ route('admin.job_vacancies.index') }}" class="text-blue-500 hover:underline">Kembali</a>
</div>
@endsection
