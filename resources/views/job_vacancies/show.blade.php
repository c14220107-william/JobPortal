@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">{{$jobVacancy->title}}</h2>
    <p class="text-gray-700 text-center mb-6"> {{$jobVacancy->description}} </p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600"><strong>Requirement:</strong> {{ $jobVacancy->requirement }}</p>
            <p class="text-gray-600"><strong>Location:</strong> {{ $jobVacancy->location->name }}</p>
            <p class="text-gray-600"><strong>Benefit:</strong> {{ $jobVacancy->benefit }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600"><strong>Available From:</strong> {{ $jobVacancy->available_from_date }}</p>
            <p class="text-gray-600"><strong>Available To:</strong> {{ $jobVacancy->available_to_date }}</p>
            <p class="text-gray-600"><strong>Kuota:</strong> {{ $jobVacancy->kebutuhan }}</p>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->role === 'user')
        <form action="{{ route('job_vacancies.apply', $jobVacancy->id) }}" method="POST" class="mt-8 bg-gray-50 p-6 rounded-lg shadow-lg">
            @csrf
            {{-- <h3 class="text-lg font-semibold text-gray-800 mb-4">Submit Your Application</h3> --}}
            <div class="mb-6">
                <label for="resume_link" class="block text-gray-800 font-medium mb-2">Cover Letter (optional):</label>
                <textarea name="resume_link" id="resume_link"
                    class="w-full shadow-sm border rounded-lg py-2 px-4 focus:outline-none focus:ring focus:ring-green-400"
                    rows="5" placeholder="Write your cover letter here..."></textarea>
            </div>
            @if ($application)
                <p class="text-red-600 font-medium text-center">You have already applied for this job.</p>
            @else
                <button type="submit"
                    class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-lg w-full transition duration-300 transform hover:scale-105">
                    Apply for this Job
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