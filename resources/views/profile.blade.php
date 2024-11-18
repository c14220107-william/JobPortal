<!-- resources/views/user/profile.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Profile</h1>
    <p>Name: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    <!-- Tambahkan informasi lain jika diperlukan -->
</div>
@endsection
