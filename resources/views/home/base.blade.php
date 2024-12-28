<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg sticky top-0 z-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-4">
                <div class="flex justify-between items-end py-4">
                    <!-- Logo -->
                    <a href="#"
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

                    <!-- Navigation Menu -->
                    <nav class="hidden md:flex  space-x-6">
                        <a href="#" class="text-white hover:text-blue-300 text-lg">Home</a>
                        <a href="#activities" class="text-white hover:text-blue-300 text-lg">Activities</a>
                        <a href="#events" class="text-white hover:text-blue-300 text-lg">Events</a>
                        <a href="#about" class="text-white hover:text-blue-300 text-lg">About</a>
                        <a href="/login" class="text-white hover:text-blue-300 text-lg">Login</a>
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

                <!-- Mobile Menu -->
                <nav id="mobile-menu"
                    class="hidden md:hidden flex flex-col space-y-2 mt-2 bg-purple-700 text-white p-4 rounded-lg">
                    <a href="#" class="hover:text-blue-300 text-lg">Home</a>
                    <a href="#activities" class="hover:text-blue-300 text-lg">Activities</a>
                    <a href="#events" class="hover:text-blue-300 text-lg">Events</a>
                    <a href="#about" class="hover:text-blue-300 text-lg">About</a>
                    <a href="#login" class="hover:text-blue-300 text-lg">Login</a>
                </nav>
            </div>
        </header>
        <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between py-16">
                    <!-- Texte principal -->
                    <div class="text-center md:text-left md:w-1/2">
                        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                            Rejoignez le <span class="text-yellow-300">SuptechOlympiad</span>
                        </h1>
                        <p class="text-lg md:text-xl mb-8">
                            Participez à des activités passionnantes telles que le <strong>ping-pong</strong>, le
                            <strong>basketball</strong>, le <strong>football</strong> et les <strong>échecs</strong>.
                            Découvrez, apprenez et brillez !
                        </p>
                        <div class="flex flex-col sm:flex-row sm:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="#activities"
                                class="bg-yellow-400 text-blue-800 px-6 py-3 rounded-lg font-bold text-lg hover:bg-yellow-500">
                                Découvrir les activités
                            </a>
                            <a href="/register"
                                class="bg-white text-blue-800 px-6 py-3 rounded-lg font-bold text-lg hover:bg-gray-200">
                                S'inscrire maintenant
                            </a>
                        </div>
                    </div>

                    <!-- Carousel auto-glissant -->
                    <div class="mt-10 md:mt-0 md:w-1/2 relative">
                        <div class="relative w-full h-[300px] overflow-hidden rounded-lg shadow-lg">
                            <!-- Carousel avec une image de fond -->
                            <div id="carousel"
                                class="flex items-end justify-center pb-2 md:w-full w-[350px] h-full bg-cover bg-center bg-no-repeat"
                                style="background-image: url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/ping pong.png');">
                                <h3 id="carousel-image-name"
                                    class="text-white text-center text-xl font-bold bg-black/50 p-2 rounded-md">
                                    Ping Pong
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="activities" class="bg-gray-100 py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-12">
                    Nos Activités
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Carte d'activité -->
                    <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                        <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                            style="background-image: url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/ping pong.png');">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">Ping Pong</h3>
                            <p class="text-gray-600 mt-2">Un sport rapide et stratégique pour les passionnés de
                                raquette.</p>
                        </div>
                    </div>

                    <!-- Carte d'activité -->
                    <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                        <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                            style="background-image: url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/gaming.png');">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">Basketball</h3>
                            <p class="text-gray-600 mt-2">Rejoignez l'équipe et shootez vos paniers !</p>
                        </div>
                    </div>

                    <!-- Carte d'activité -->
                    <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                        <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                            style="background-image: url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/chess.png');">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">Football</h3>
                            <p class="text-gray-600 mt-2">Montrez vos talents et marquez des buts spectaculaires.</p>
                        </div>
                    </div>

                    <!-- Carte d'activité -->
                    <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                        <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                            style="background-image: url('http://localhost:8000/images/foot.png');">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">Échecs</h3>
                            <p class="text-gray-600 mt-2">Un jeu de stratégie pour stimuler votre esprit et votre
                                réflexion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Événements Récents</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Événement 1 -->
                    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                        <img src="https://via.placeholder.com/400" alt="Tournoi de Basket" class="rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tournoi de Basket 2024</h3>
                        <p class="text-gray-600 mb-4">Date : 25 Décembre 2024<br>Lieu : Gymnase Universitaire</p>
                        <a href="#"
                            class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">Voir les
                            détails</a>
                    </div>

                    <!-- Événement 2 -->
                    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                        <img src="https://via.placeholder.com/400" alt="Tournoi de Football" class="rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tournoi de Football 2024</h3>
                        <p class="text-gray-600 mb-4">Date : 30 Décembre 2024<br>Lieu : Terrain Sportif A</p>
                        <a href="#"
                            class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">Voir les
                            détails</a>
                    </div>

                    <!-- Événement 3 -->
                    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                        <img src="https://via.placeholder.com/400" alt="Tournoi de Ping-Pong"
                            class="rounded-lg mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tournoi de Ping-Pong 2024</h3>
                        <p class="text-gray-600 mb-4">Date : 5 Janvier 2025<br>Lieu : Salle de Ping-Pong</p>
                        <a href="#"
                            class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">Voir les
                            détails</a>
                    </div>
                </div>
            </div>
        </section>



    </div>
    <script>
        // Mobile Menu Toggle Script
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        mobileMenuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        // Script pour le carousel auto-glissant
        const carousel = document.getElementById("carousel");
        const carouselImageName = document.getElementById("carousel-image-name");
        //carousel.style.backgroundImage = "url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/ping pong.png')";
        let index = 0;

        const images = ["chess", "gaming", "ping pong"];

        function slideCarousel() {
            if (index >= images.length) {
                index = 0;
            }
            carousel.style.backgroundImage =
                `url('https://www.suptech-sante.ma/SUPTECH_SANTE-main/assets/${images[index]}.png')`
            carousel.style.transition = "0.5s";
            carouselImageName.innerText = images[index];
            index++;
        }

        setInterval(slideCarousel, 3000); // Change d'image toutes les 3 secondes
    </script>
</body>

</html>
