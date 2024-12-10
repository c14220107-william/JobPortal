@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $jobVacancy->title }}</h1>
    <p class="text-lg text-gray-700 mb-4"><strong>Description: </strong> {{ $jobVacancy->description }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <p class="text-gray-600"><strong>Requirement:</strong> {{ $jobVacancy->requirement }}</p>
            <p class="text-gray-600"><strong>Location:</strong> {{ $jobVacancy->location->name }}</p>
            <p class="text-gray-600"><strong>Benefit:</strong> {{ $jobVacancy->benefit }}</p>
            {{-- <p class="text-gray-600"><strong>Additional Information:</strong> {{ $jobVacancy->additional_info }}
            </p> --}}
        </div>
        <div>
            <p class="text-gray-600"><strong>Available From:</strong> {{ $jobVacancy->available_from_date }}</p>
            <p class="text-gray-600"><strong>Available To:</strong> {{ $jobVacancy->available_to_date }}</p>
            <p class="text-gray-600"><strong>Kuota:</strong> {{ $jobVacancy->kebutuhan }}</p>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->role === 'user')
        <form action="{{ route('job_vacancies.apply', $jobVacancy->id) }}" method="POST"
            class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-6">
            @csrf
            <div class="mb-4">
                <label for="resume_link" class="block text-gray-700 text-sm font-bold mb-2">Cover Letter (optional):</label>
                <textarea name="resume_link" id="resume_link"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    rows="4"></textarea>
            </div>
            @if ($application)
                <p class="text-red-600">Anda Sudah Melamar</p>

            @else
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Apply for this job
                </button>
            @endif

        </form>
    @elseif (Auth::check() && Auth::user()->role === 'admin')
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <p class="text-gray-700 text-lg">Hello Admin, you can manage this job vacancy here.</p>
        </div>
    @else
        <p class="text-gray-700">Please <a href="{{ route('login') }}" class="text-green-600 hover:underline">login</a> to
            apply for this job.</p>
    @endif
</div>
@endsection