@extends('layouts.app')
@section('title', 'Tableau de bord Participant')
@section('content')
    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Tableau de bord Participant</h1>

        <!-- Affichage du nom et prénom du participant -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-2">Bienvenue, {{ $user->prenom }} {{ $user->nom }}</h2>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="p-6 bg-blue-100 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-blue-500 flex items-center">
                    <i class="fas fa-gamepad text-5xl mr-4 "></i> <span>Nombre de matchs joués</span>
                </h2>
                <p class="text-3xl font-bold text-blue-600 mt-2 text-center">{{ $gamesPlayed }}</p>
            </div>
            <div class="p-6 bg-green-100 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-green-600 flex items-center">
                    <i class="fas fa-clock text-4xl mr-2"></i> <span>Matchs à venir</span>
                </h2>
                <p class="text-3xl font-bold text-green-600 mt-2 text-center">{{ $upcomingGames }}</p>
            </div>
            <div class="p-6 bg-yellow-100 rounded-lg shadow">
                <h2 class="text-xl font-semibold text-yellow-500 flex items-center">
                    <i class="fas fa-trophy text-4xl mr-2"></i> <span>Matchs terminés</span>
                </h2>
                <p class="text-3xl font-bold text-yellow-600 mt-2 text-center">{{ $completedGames }}</p>
            </div>
        </div>

        <!-- Statistiques par activité -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Répartition des activités ({{ now()->year }})</h2>
                <div class="relative" style="height: 300px; width: 100%;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Statistiques des activités -->
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Statistiques des activités</h2>
                <ul>
                    @foreach ($activityStats as $activity)
                        <li class="mb-4">
                            <span class="font-semibold">{{ $activity['name'] }}:</span> {{ $activity['games'] }} matchs
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Graphique des activités
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'bar',
            data: {
                labels: @json($activityStats->pluck('name')),
                datasets: [{
                    label: 'Nombre de matchs',
                    data: @json($activityStats->pluck('games')),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
@endsection
