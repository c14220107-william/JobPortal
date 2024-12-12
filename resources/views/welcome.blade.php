@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-cover bg-center h-screen" style="background-image: url('/imgs/buat-home.jpg');">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 to-gray-800 opacity-80"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center" data-aos="fade-up">
        <h1 class="text-white text-6xl font-extrabold tracking-wide leading-tight">
            Selamat Datang di <span class="text-green-500">JobPortal</span>
        </h1>
        <p class="mt-4 text-gray-200 text-lg max-w-3xl">
            Temukan karir impian Anda bersama <span class="font-semibold text-white">PK Brands</span>. Bersama kami, masa depan Anda lebih berwarna.
        </p>
        <a href="#why-join-us" class="mt-6 text-lg font-semibold text-green-400 hover:text-green-200 transition underline cursor-pointer">
            See more about us
        </a>
    </div>
</div>

<!-- Sections Background -->
<div class="bg-gradient-to-r from-green-50 via-blue-50 to-green-50">

    <!-- Why Join Us Section -->
    <div id="why-join-us" class="container mx-auto px-6 py-16">
        <h2 class="text-4xl font-bold text-gray-800 text-center mb-12" data-aos="fade-right">
            Kenapa Bergabung dengan Kami?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @foreach ([
                ['title' => 'Satu Tujuan', 'img' => '/imgs/home-icon1.jpeg', 'desc' => 'Kami berbagi ide dan nilai untuk mencapai tujuan bersama.'],
                ['title' => 'Pengalaman Tanpa Batas', 'img' => '/imgs/home-icon2.jpeg', 'desc' => 'Temukan inspirasi dan keahlian baru setiap hari.'],
                ['title' => 'Masa Depan Lebih Berwarna', 'img' => '/imgs/home-icon3.jpeg', 'desc' => 'Bentuk masa depan cerah dengan kontribusi Anda.'],
                ['title' => 'Lingkungan Positif', 'img' => '/imgs/lingkungan-positif.jpg', 'desc' => 'Kami menciptakan lingkungan kerja yang mendukung dan inklusif.']
            ] as $index => $feature)
            <div class="relative bg-white shadow-lg rounded-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <img src="{{ $feature['img'] }}" alt="{{ $feature['title'] }}" class="w-20 h-20 mx-auto rounded-full shadow-md">
                <h3 class="mt-6 text-2xl font-semibold text-center text-green-600">{{ $feature['title'] }}</h3>
                <p class="mt-4 text-gray-600 text-center leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- How We Work Section -->
    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <img src="/imgs/bagaimana-kami-bekerja.jpg" alt="Work Process" class="rounded-lg shadow-lg">
            </div>
            <div class="flex flex-col justify-center space-y-6" data-aos="fade-left">
                <h2 class="text-4xl font-bold text-green-600 leading-tight">
                    Bagaimana Kami Bekerja
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Kami percaya bahwa kolaborasi adalah kunci kesuksesan. Dengan proses kerja yang terstruktur dan inovatif, kami terus memberikan dampak positif bagi pelanggan kami.
                </p>
                <div class="flex items-center space-x-4">
                    <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold">1</div>
                    <p class="text-gray-700 text-lg">Diskusi Ide dan Strategi</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold">2</div>
                    <p class="text-gray-700 text-lg">Pengembangan Produk Inovatif</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-green-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold">3</div>
                    <p class="text-gray-700 text-lg">Implementasi dengan Hasil Maksimal</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="py-16 text-center">
        <h2 class="text-4xl font-bold text-green-600 mb-6" data-aos="fade-up">Bersiaplah untuk Masa Depan Anda</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8" data-aos="fade-up" data-aos-delay="200">
            Jangan lewatkan kesempatan untuk bergabung dengan tim kami yang penuh semangat. Daftar sekarang dan mulai perjalanan karir Anda bersama kami.
        </p>
        <a href="{{ route('job_vacancies.index') }}" class="px-10 py-4 bg-green-600 text-white font-semibold rounded-full shadow-lg hover:bg-green-500 transition transform hover:scale-105" data-aos="zoom-in">
            Jelajahi Lowongan
        </a>
    </div>
</div>
@endsection

<script>
    // Smooth scroll for "See more about us" button
    document.addEventListener('DOMContentLoaded', function () {
        const link = document.querySelector('a[href="#why-join-us"]');
        if (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector('#why-join-us').scrollIntoView({
                    behavior: 'smooth'
                });
            });
        }
    });
</script>
