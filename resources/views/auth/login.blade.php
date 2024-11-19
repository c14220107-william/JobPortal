@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 via-white to-green-50">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-6 text-green-800">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                Login
            </button>
        </form>
        <p class="text-center text-gray-600 mt-4">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-green-600 hover:underline">
                Register here
            </a>
        </p>
    </div>
</div>
@endsection
