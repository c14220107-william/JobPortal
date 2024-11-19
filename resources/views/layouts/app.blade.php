<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />


</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a class="text-xl font-bold text-gray-800 hover:text-gray-700" href="/">Job Portal</a>
            <div class="flex items-center space-x-4">
                @if (Route::currentRouteName() == 'job_vacancies.index')
                    @if (Auth::check())
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('profile') }}">Profile</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    @else
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('login') }}">Login</a>
                        <a class="text-gray-600 hover:text-gray-900" href="{{ route('register') }}">Register</a>
                    @endif
                @endif
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto px-6 py-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-green-600 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold">Terhubung Dengan Kami</h2>
            <p class="mt-4 text-lg">Berbagi inspirasi untuk Indonesia yang #LebihBerwarna</p>
            <div class="flex justify-center mt-6 space-x-6">
                <a href="#" class="hover:scale-110 transform transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" 
                         alt="Facebook" class="w-8">
                </a>
                <a href="#" class="hover:scale-110 transform transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" 
                         alt="Instagram" class="w-8">
                </a>
                <a href="#" class="hover:scale-110 transform transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/81/LinkedIn_icon.svg" 
                         alt="LinkedIn" class="w-8">
                </a>
                <a href="#" class="hover:scale-110 transform transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/98/YouTube_Logo_%282013-2017%29.svg" 
                         alt="YouTube" class="w-8">
                </a>
            </div>
        </div>
    </footer>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.1/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Durasi animasi dalam milidetik
            easing: 'ease-in-out', // Jenis easing
            once: true, // Animasi hanya terjadi satu kali
        });
    </script>

</body>
</html>
