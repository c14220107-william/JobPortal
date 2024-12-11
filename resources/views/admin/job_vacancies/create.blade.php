<!-- resources/views/admin/job_vacancies/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 tracking-wide">Tambah Lowongan Baru</h2>
        <p class="text-gray-600 mt-2">Isi form berikut untuk menambahkan lowongan pekerjaan baru</p>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-8 bg-red-50 border-l-4 border-red-500 rounded-r-lg p-4 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Ada beberapa kesalahan pada form:</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Form -->
    <form action="{{ route('admin.job_vacancies.store') }}" method="POST"
        class="bg-white shadow-lg rounded-lg overflow-hidden">
        @csrf

        <!-- Basic Information Section -->
        <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Dasar</h3>
            <p class="mt-1 text-sm text-gray-500">Informasi utama lowongan pekerjaan.</p>
        </div>

        <div class="px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Lowongan <span
                            class="text-red-500">*</span></label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="text" name="title" id="title"
                            class="block w-full rounded-md border-gray-300 pr-10 focus:border-green-500 focus:ring-green-500 sm:text-sm @error('title') border-red-300 text-red-900 placeholder-red-300 @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="id_position" class="block text-sm font-medium text-gray-700">Posisi <span
                            class="text-red-500">*</span></label>
                    <select name="id_position" id="id_position"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('id_position') border-red-300 text-red-900 @enderror"
                        required>
                        <option value="">Pilih Posisi</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}" {{ old('id_position') == $position->id ? 'selected' : '' }}>
                                {{ $position->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_position')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="id_location" class="block text-sm font-medium text-gray-700">Lokasi <span
                            class="text-red-500">*</span></label>
                    <select name="id_location" id="id_location"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('id_location') border-red-300 text-red-900 @enderror"
                        required>
                        <option value="">Pilih Lokasi</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('id_location') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="id_department" class="block text-sm font-medium text-gray-700">Departemen <span
                            class="text-red-500">*</span></label>
                    <select name="id_department" id="id_department"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('id_department') border-red-300 text-red-900 @enderror"
                        required>
                        <option value="">Pilih Departemen</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('id_department') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_department')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Period Section -->
        <div class="mt-8 border-t border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Periode dan Kuota</h3>
            <p class="mt-1 text-sm text-gray-500">Tentukan periode dan jumlah kebutuhan.</p>
        </div>

        <div class="px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Available From Date -->
                <div>
                    <label for="available_from_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="available_from_date" id="available_from_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('available_from_date') border-red-300 text-red-900 @enderror"
                        value="{{ old('available_from_date') }}" required>
                    @error('available_from_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Available To Date -->
                <div>
                    <label for="available_to_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir
                        <span class="text-red-500">*</span></label>
                    <input type="date" name="available_to_date" id="available_to_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('available_to_date') border-red-300 text-red-900 @enderror"
                        value="{{ old('available_to_date') }}" required>
                    @error('available_to_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kebutuhan -->
                <div>
                    <label for="kebutuhan" class="block text-sm font-medium text-gray-700">Jumlah Kebutuhan <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="kebutuhan" id="kebutuhan" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('kebutuhan') border-red-300 text-red-900 @enderror"
                        value="{{ old('kebutuhan') }}" required>
                    @error('kebutuhan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Job Details Section -->
        <div class="mt-8 border-t border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Pekerjaan</h3>
            <p class="mt-1 text-sm text-gray-500">Informasi lengkap tentang lowongan pekerjaan.</p>
        </div>

        <div class="px-6 py-6 space-y-6">
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pekerjaan <span
                        class="text-red-500">*</span></label>
                <div class="mt-1">
                    <textarea name="description" id="description" rows="4"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('description') border-red-300 text-red-900 @enderror"
                        required>{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Requirements -->
            <div>
                <label for="requirement" class="block text-sm font-medium text-gray-700">Persyaratan <span
                        class="text-red-500">*</span></label>
                <div class="mt-1">
                    <textarea name="requirement" id="requirement" rows="4"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('requirement') border-red-300 text-red-900 @enderror"
                        required>{{ old('requirement') }}</textarea>
                </div>
                @error('requirement')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Benefits -->
            <div>
                <label for="benefit" class="block text-sm font-medium text-gray-700">Benefit <span
                        class="text-red-500">*</span></label>
                <div class="mt-1">
                    <textarea name="benefit" id="benefit" rows="4"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('benefit') border-red-300 text-red-900 @enderror"
                        required>{{ old('benefit') }}</textarea>
                </div>
                @error('benefit')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Additional Info -->
            <div>
                <label for="additional_info" class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
                <div class="mt-1">
                    <textarea name="additional_info" id="additional_info" rows="3"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm @error('additional_info') border-red-300 text-red-900 @enderror">{{ old('additional_info') }}</textarea>
                </div>
                @error('additional_info')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
            <a href="{{ route('admin.job_vacancies.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Lowongan
            </button>
        </div>
    </form>
</div>
@endsection