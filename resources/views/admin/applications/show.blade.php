@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Detail Aplikasi</h1>

        <!-- Informasi Pelamar -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Informasi Pelamar</h2>
            <p><strong>Nama:</strong> {{ $application->user->name }}</p>
            <p><strong>Email:</strong> {{ $application->user->email }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $application->user->nomor_telepon }}</p>
            <p><strong>Tempat Lahir:</strong> {{ $application->user->tempat_lahir }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $application->user->tanggal_lahir }}</p>
            <p><strong>Alamat:</strong> {{ $application->user->alamat }}</p>
            <p><strong>Jenjang Pendidikan:</strong> {{ $application->user->jenjang_pendidikan }}</p>
            <p><strong>Asal Universitas:</strong> {{ $application->user->asal_universitas }}</p>
            <p><strong>Pekerjaan Terakhir:</strong> {{ $application->user->pekerjaan_terakhir }}</p>
            <p><strong>Total Lama Bekerja:</strong> {{ $application->user->total_lama_bekerja }}</p>
            <p><strong>Bio:</strong> {{ $application->user->bio }}</p>
            <p><strong>Resume Link:</strong> 
                <a href="{{Storage::disk('s3')->url($application->user->resume_link) }}" target="_blank" class="text-blue-500 underline">
                    Download Resume
                </a>
            </p>
            
        </div>

        <!-- Foto Profil -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Foto</h2>
            @if ($application->user->profile_picture)
                <a href="{{ Storage::disk('s3')->url($application->user->profile_picture) }}" target="_blank">
                    <img src="{{ Storage::disk('s3')->url($application->user->profile_picture) }}" alt="Profile Picture" class="w-64 h-64 square-full">
                </a>
                
            @else
                <p class="text-gray-500">Foto profil tidak tersedia.</p>
            @endif
        </div>

        <!-- Detail Pekerjaan -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Detail Pekerjaan</h2>
            <p><strong>Judul Pekerjaan:</strong> {{ $application->jobVacancy->title }}</p>
            <p><strong>Waktu Melamar:</strong> {{ $application->created_at->format('d M Y, H:i') }}</p>
        </div>

        <!-- Cover Letter -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Cover Letter</h2>
            <p class="border-l-4 border-blue-500 pl-4 text-gray-700">{{ $application->cover_letter }}</p>
        </div>

        <a href="{{ route('admin.applications.index')}}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Kembali ke Daftar Aplikasi
        </a>

        <!-- Tombol Terima -->
        <form action="{{ route('admin.applications.accept', $application->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
                Terima
            </button>
        </form>

        <!-- Tombol Tolak -->
        <form action="{{ route('admin.applications.reject', $application->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="inline-block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
                Tolak
            </button>
        </form>
    </div>
</div>

<script>
    function openModal(imageSrc) {
        const modal = document.getElementById('profilePictureModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('profilePictureModal');
        modal.classList.add('hidden');
    }


</script>
@endsection
