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
</head>

<body class="font-sans text-gray-900 antialiased">
    <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg sticky top-0 z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-4">
            <div class="flex justify-between items-end py-4">
                <!-- logo -->
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

                <!-- navigation menu (desktop) -->
                <nav class="hidden md:flex space-x-6">
                    <a href="/#home" class="text-white hover:text-blue-300 text-lg">Acceuil</a>
                    <a href="/#activities" class="text-white hover:text-blue-300 text-lg">Activities</a>
                    <a href="{{ route('home.classements') }}"
                        class="text-white hover:text-blue-300 text-lg">Classement</a>
                    <a href="/#events" class="text-white hover:text-blue-300 text-lg">Events</a>
                    <a href="{{ route('home.matches') }}" class="text-white hover:text-blue-300 text-lg">Matches</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="text-white hover:text-blue-300 text-lg">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <a href="/register" class="text-white hover:text-blue-300 text-lg">Register</a>
                        <a href="/login" class="text-white hover:text-blue-300 text-lg">Login</a>
                    @endguest
                </nav>

                <!-- mobile menu button -->
                <button id="mobile-menu-button"
                    class="block md:hidden text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- mobile menu -->
            <nav id="mobile-menu"
                class="hidden md:hidden flex flex-col space-y-2 mt-2 bg-purple-700 text-white p-4 rounded-lg">
                <a href="/#home" class="hover:text-blue-300 text-lg">Acceuil</a>
                <a href="/#activities" class="hover:text-blue-300 text-lg">Activities</a>
                <a href="/#events" class="hover:text-blue-300 text-lg">Events</a>
                <a href="{{ route('home.classements') }}" class="hover:text-blue-300 text-lg">Classement</a>
                <a href="{{ route('home.matches') }}" class="hover:text-blue-300 text-lg">Matches</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-white hover:text-blue-300 text-lg">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="/register" class="hover:text-blue-300 text-lg">Register</a>
                    <a href="/login" class="hover:text-blue-300 text-lg">Login</a>
                @endguest
            </nav>
        </div>

        <script>
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        </script>
    </header>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-full  sm:max-w-md mt-2 py-6 px-6  bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg ">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
