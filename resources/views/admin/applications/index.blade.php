@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Aplikasi Pekerjaan</h1>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr>
                <th class="py-3 px-4 border-b text-left text-gray-700">Nama Pelamar</th>
                <th class="py-3 px-4 border-b text-left text-gray-700">Judul Pekerjaan</th>
                <th class="py-3 px-4 border-b text-left text-gray-700">Waktu Melamar</th>
                <th class="py-3 px-4 border-b text-left text-gray-700">Status</th>
                <th class="py-3 px-4 border-b text-left text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
            <tr class="hover:bg-gray-100">
                <td class="py-3 px-4 border-b">{{ $application->user->name }}</td>
                <td class="py-3 px-4 border-b">{{ $application->jobVacancy->title }}</td>
                <td class="py-3 px-4 border-b">{{ $application->created_at->format('d M Y, H:i') }}</td>
                <td class="py-3 px-4 border-b">{{ $application->status }}</td>

                <td class="py-3 px-4 border-b">
                    <a href="{{ route('admin.applications.show', $application->id) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="mt-6">
        {{ $applications->links() }}
    </div> --}}
</div>
@endsection
