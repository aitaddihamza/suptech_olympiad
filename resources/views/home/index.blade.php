@extends('home.base')
@section('title', 'Acceuil')
@section('content')
    <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between py-16">
                <!-- texte principal -->
                <div class="text-center md:text-left md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                        rejoignez le <span class="text-yellow-300">suptecholympiad</span>
                    </h1>
                    <p class="text-lg md:text-xl mb-8">
                        participez à des activités passionnantes telles que le <strong>ping-pong</strong>, le
                        <strong>basketball</strong>, le <strong>football</strong> et les <strong>échecs</strong>.
                        découvrez, apprenez et brillez !
                    </p>
                    <div class="flex flex-col sm:flex-row sm:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#activities"
                            class="bg-yellow-400 text-blue-800 px-6 py-3 rounded-lg font-bold text-lg hover:bg-yellow-500">
                            découvrir les activités
                        </a>
                        <a href="/register"
                            class="bg-white text-blue-800 px-6 py-3 rounded-lg font-bold text-lg hover:bg-gray-200">
                            s'inscrire maintenant
                        </a>
                    </div>
                </div>

                <!-- carousel auto-glissant -->
                <div class="mt-10 md:mt-0 md:w-1/2 relative">
                    <div class="relative w-full h-[300px] overflow-hidden rounded-lg shadow-lg">
                        <!-- carousel avec une image de fond -->
                        <div id="carousel"
                            class="flex items-end justify-center pb-2 md:w-full w-[350px] h-full bg-cover bg-center bg-no-repeat"
                            style="background-image: url('http://localhost:8000/images/pong.jpg');">
                            <h3 id="carousel-image-name"
                                class="text-white text-center text-xl font-bold bg-black/50 p-2 rounded-md">
                                ping pong
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
                nos activités
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- carte d'activité -->
                <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                    <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                        style="background-image: url('http://localhost:8000/images/pingpong.jpg');">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">ping pong</h3>
                        <p class="text-gray-600 mt-2">un sport rapide et stratégique pour les passionnés de
                            raquette.</p>
                    </div>
                </div>

                <!-- carte d'activité -->
                <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                    <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                        style="background-image: url('http://localhost:8000/images/basket.jpg');">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">basketball</h3>
                        <p class="text-gray-600 mt-2">rejoignez l'équipe et shootez vos paniers !</p>
                    </div>
                </div>

                <!-- carte d'activité -->
                <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                    <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                        style="background-image: url('http://localhost:8000/images/foot.jpg');">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">football</h3>
                        <p class="text-gray-600 mt-2">montrez vos talents et marquez des buts spectaculaires.</p>
                    </div>
                </div>

                <!-- carte d'activité -->
                <div class="relative group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl">
                    <div class="w-full h-48 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                        style="background-image: url('http://localhost:8000/images/chess.jpg');">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600">échecs</h3>
                        <p class="text-gray-600 mt-2">un jeu de stratégie pour stimuler votre esprit et votre
                            réflexion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">événements récents</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- événement 1 -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                    <img src="http://localhost:8000/images/basket1.jpg" alt="tournoi de basket" class="rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">tournoi de basket 2024</h3>
                    <p class="text-gray-600 mb-4">date : 25 décembre 2024<br>lieu : gymnase universitaire</p>
                    <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">voir
                        les
                        détails</a>
                </div>

                <!-- événement 2 -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                    <img src="http://localhost:8000/images/ball.jpg" alt="tournoi de football" class="rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">tournoi de football 2024</h3>
                    <p class="text-gray-600 mb-4">date : 30 décembre 2024<br>lieu : terrain sportif a</p>
                    <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">voir
                        les
                        détails</a>
                </div>

                <!-- événement 3 -->
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col">
                    <img src="http://localhost:8000/images/pong.jpg" alt="tournoi de ping-pong" class="rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">tournoi de ping-pong 2024</h3>
                    <p class="text-gray-600 mb-4">date : 5 janvier 2025<br>lieu : salle de ping-pong</p>
                    <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md text-center">voir
                        les
                        détails</a>
                </div>
            </div>
        </div>
    </section>

@endsection
