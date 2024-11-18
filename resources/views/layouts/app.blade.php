<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a class="text-xl font-bold text-gray-800 hover:text-gray-700" href="/">Job Portal</a>
            <div class="flex items-center space-x-4">
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
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.2.1/cdn.min.js" defer></script>
</body>
</html>
