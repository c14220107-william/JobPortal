<!-- resources/views/jobs/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $jobVacancy->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $jobVacancy->description }}</p>
        <p class="text-gray-600 mb-6"><strong>Requirement:</strong> {{ $jobVacancy->requirement }}</p>
    
        <p class="text-gray-600 mb-6"><strong>Location:</strong> {{ $jobVacancy->location->name }}</p>
        <p class="text-gray-600 mb-6"><strong>Benefit:</strong> {{ $jobVacancy->benefit }}</p>
        <p class="text-gray-600 mb-6"><strong>Aditional Information:</strong> {{ $jobVacancy->additional_info }}</p>
        <p class="text-gray-600 mb-6"><strong>Available from Date:</strong> {{ $jobVacancy->available_from_date }}</p>
        <p class="text-gray-600 mb-6"><strong>Available to Date:</strong> {{ $jobVacancy->available_to_date }}</p>
        <p class="text-gray-600 mb-6"><strong>Kuota:</strong> {{ $jobVacancy->kebutuhan }}</p>

        @if (Auth::check() && Auth::user()->role === 'user')
            <form action="{{ route('job_vacancies.apply', $jobVacancy->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label for="resume_link" class="block text-gray-700 text-sm font-bold mb-2">Cover Letter (optional):</label>
                    <textarea name="resume_link" id="resume_link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Apply for this job
                </button>
            </form>
        @elseif (Auth::check() && Auth::user()->role === 'admin')
        <p class="text-gray-700">Halo Admin</p>

        @else
            <p class="text-gray-700">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">login</a> to apply for this job.</p>
        @endif
    </div>
@endsection
