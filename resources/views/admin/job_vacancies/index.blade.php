<!-- resources/views/admin/jobs/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">Daftar Pekerjaan</h2>
    <a href="{{ route('admin.job_vacancies.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambah Pekerjaan Baru</a>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Lokasi</th>
                    <th class="py-3 px-6 text-left">Departemen</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($jobVacancies as $job)
                <tr class="border-t border-gray-200">
                    <td class="py-3 px-6">{{ $job->title }}</td>
                    <td class="py-3 px-6">{{ $job->location->name }}</td>
                    <td class="py-3 px-6">{{ $job->department->name  }}</td>
                    <td class="py-3 px-6">{{ $job->is_open ? 'Dibuka' : 'Ditutup' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.job_vacancies.edit', $job->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('admin.job_vacancies.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pekerjaan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
