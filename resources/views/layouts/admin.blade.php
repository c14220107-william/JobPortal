{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col min-h-screen">
        <!-- Header atau navbar admin -->
        <header class="bg-blue-800 text-white shadow-md py-4">
            <div class="container mx-auto flex justify-between items-center px-4">
                <h1 class="text-lg font-semibold">Admin Dashboard</h1>
                <nav class="space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                    <a href="{{ route('admin.job_vacancies.index') }}" class="hover:underline">Manage Jobs</a>
                    <a href="{{ route('admin.applications.index') }}" class="hover:underline">Applications</a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="hover:underline text-red-400">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </div>
        </header>

        <!-- Konten admin -->
        <main class="flex-grow container mx-auto px-4 py-6">
            <div class="bg-white shadow rounded-lg p-6">
                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-200 text-center text-gray-600 py-4">
            <p>&copy; {{ date('Y') }} Job Portal Admin. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
