@extends('layouts.app')

@section('content')
<div class="relative bg-cover bg-center h-screen" style="background-image: url('/imgs/home-banner.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-transparent opacity-80"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center" data-aos="fade-up">
        <h1 class="text-white text-5xl font-extrabold tracking-wide">Selamat Datang di JobPortal</h1>
        <p class="mt-4 text-gray-200 text-lg max-w-2xl">
            Temukan karir impianmu bersama Avian Brands.
        </p>
        <a href="{{ route('job_vacancies.index') }}" class="mt-6 px-8 py-4 bg-green-600 hover:bg-green-500 text-white text-lg font-semibold rounded-lg shadow-md transition" data-aos="zoom-in">
            Jelajahi Lowongan
        </a>
    </div>
</div>

<div class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-semibold text-gray-800 text-center mb-8" data-aos="fade-right">Kenapa Bergabung dengan Kami?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ([
            ['title' => 'Satu Tujuan', 'img' => '/imgs/home-icon1.jpeg', 'desc' => 'Kami berbagi ide dan nilai untuk mencapai tujuan bersama.'],
            ['title' => 'Pengalaman Tanpa Batas', 'img' => '/imgs/home-icon2.jpeg', 'desc' => 'Temukan inspirasi dan keahlian baru setiap hari.'],
            ['title' => 'Masa Depan Lebih Berwarna', 'img' => '/imgs/home-icon3.jpeg', 'desc' => 'Bentuk masa depan cerah dengan kontribusi Anda.']
        ] as $index => $feature)
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <img src="{{ $feature['img'] }}" alt="{{ $feature['title'] }}" class="w-16 h-16 mx-auto">
            <h3 class="mt-4 text-xl font-medium text-center text-green-700">{{ $feature['title'] }}</h3>
            <p class="mt-2 text-gray-600 text-center">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>


@endsection
