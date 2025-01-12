<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50 flex flex-col min-h-screen ">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 flex-grow">
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
                            <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                                class="text-white hover:text-blue-300 text-lg">mon
                                espace</a>
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
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="hover:text-blue-300 text-lg">mon
                            espace</a>
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
        <main class="flex-1">
            @yield('content')
        </main>
    </div>

    <footer class="bg-white shadow-lg mt-8 py-4">
        <p class="text-center text-xl p-2">made by passionate software engineer Hamza Ait Addi 2024</p>
    </footer>
    <script>
        // Mobile menu toggle script
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });
        }

        // Script for auto-sliding carousel
        const carousel = document.getElementById("carousel");
        const carouselImageName = document.getElementById("carousel-image-name");

        let index = 0;
        const images = ["chess", "gaming", "pong"];

        function slideCarousel() {
            if (index >= images.length) {
                index = 0;
            }
            carousel.style.backgroundImage = `url('http://localhost:8000/images/${images[index]}.jpg')`;
            carousel.style.transition = "0.5s";
            carouselImageName.innerText = images[index];
            index++;
        }

        setInterval(slideCarousel, 4000); // Change image every 3 seconds
    </script>
</body>

</html>
