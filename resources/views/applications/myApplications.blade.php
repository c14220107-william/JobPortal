@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">My Applications</h1>

    <!-- Filter Dropdown -->
    <div class="mb-6 flex justify-between items-center">
        <form method="GET" action="{{ route('applications.myApplications') }}" class="flex items-center">
            <label for="status" class="mr-3 text-gray-700 font-medium">Filter by Status:</label>
            <select name="status" id="status" class="border border-gray-300 rounded-md py-2 px-4 focus:outline-none focus:ring focus:ring-green-300">
                <option value="">All</option>
                <option value="on_process" {{ request('status') == 'on_process' ? 'selected' : '' }}>On Process</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="not_accepted" {{ request('status') == 'not_accepted' ? 'selected' : '' }}>Not Accepted</option>
            </select>
            <button type="submit" class="ml-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Apply Filter
            </button>
        </form>
    </div>

    <!-- Applications Table -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Job Title</th>
                    <th class="py-3 px-6 text-left">Application Date</th>
                    <th class="py-3 px-6 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($applications as $application)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left font-medium">
                        {{ $application->jobVacancy->title }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $application->application_date->format('Y-m-d') }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        @if ($application->status == 'on_process')
                        <span class="bg-yellow-500 text-white py-1 px-3 rounded-full text-xs">On Process</span>
                        @elseif ($application->status == 'accepted')
                        <span class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">Accepted</span>
                        @else
                        <span class="bg-red-500 text-white py-1 px-3 rounded-full text-xs">Not Accepted</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-6 text-center text-gray-600">You haven't applied for any jobs yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
