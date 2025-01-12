<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col ">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg sticky top-0 z-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-4">
                <div class="flex justify-between items-end py-4">
                    <!-- Logo -->
                    <a href="/"
                        class="flex items-center space-x-2 text-white text-2xl font-extrabold tracking-wide hover:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8c-1.5 0-3 1.5-3 3s1.5 3 3 3 3-1.5 3-3-1.5-3-3-3z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 12c0-4.418-3.582-8-8-8S4 7.582 4 12s3.582 8 8 8 8-3.582 8-8z" />
                        </svg>
                        <span>SuptechOlympiad</span>
                    </a>

                    <!-- Navigation Menu (Desktop) -->
                    <nav class="hidden md:flex space-x-6">
                        @if (Auth::user()->role == 'admin')
                            @include('layouts.navigation.admin')
                        @else
                            @include('layouts.navigation.participant')
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="text-white hover:text-blue-300 text-lg">logout</button>
                        </form>
                    </nav>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button"
                        class="block md:hidden text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Menu (Hidden by default) -->
                <nav id="mobile-menu"
                    class="hidden md:hidden flex flex-col space-y-2 mt-2 bg-purple-700 text-white p-4 rounded-lg">
                    @if (Auth::user()->role == 'admin')
                        @include('layouts.navigation.admin')
                    @else
                        @include('layouts.navigation.participant')
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-white hover:text-blue-300 text-lg">Logout</button>
                    </form>
                </nav>
            </div>

            <!-- JavaScript to Toggle Mobile Menu -->
            <script>
                document.getElementById("mobile-menu-button").addEventListener("click", function() {
                    const mobileMenu = document.getElementById("mobile-menu");
                    mobileMenu.classList.toggle("hidden"); // Toggle visibility of the mobile menu
                });
            </script>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
