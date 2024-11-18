<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 mt-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 mt-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
        </form>
        <p class="text-center text-gray-600 mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a></p>
    </div>
</div>
@endsection
