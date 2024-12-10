<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 tracking-wide">Welcome Back!</h1>
        <p class="text-gray-600 mt-2">Hello, <span class="font-semibold">{{ Auth::user()->name }}</span></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div
            class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm hover:shadow-md transition duration-200">
            <h3 class="text-xl font-semibold text-green-700 mb-4">Job Management</h3>
            <p class="text-gray-600 mb-4">Manage all job vacancies and postings</p>
            <a href="{{ route('admin.job_vacancies.index') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Manage Jobs
            </a>
        </div>

        <div
            class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm hover:shadow-md transition duration-200">
            <h3 class="text-xl font-semibold text-green-700 mb-4">Applications</h3>
            <p class="text-gray-600 mb-4">View and manage job applications</p>
            <a href="{{ route('admin.applications.index') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                View Applications
            </a>
        </div>
    </div>
</div>
@endsection