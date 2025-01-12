@extends('layouts.app')
@section('title', 'Tableau de bord Admin')
@section('content')
    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Tableau de bord Admin</h1>

        <!-- Filtre par année -->
        <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-4 flex flex-wrap gap-4">
            <label for="year" class="text-sm font-medium">Filtrer par année :</label>
            <select name="year" id="year" class="bg-white border border-gray-300 rounded-md p-2 w-full sm:w-[300px]">
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md w-full sm:w-auto">Filtrer</button>
        </form>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            <div class="p-6 bg-blue-200 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-blue-600 flex items-center">
                        <i class="fas fa-users text-5xl mr-4 text-blue-500"></i> <span>Nombre total des participants</span>
                    </h2>
                    <p class="text-4xl font-bold text-center mt-2 text-blue-600">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="p-6 bg-green-200 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-green-600 flex items-center">
                        <i class="fas fa-gamepad text-5xl mr-4 text-green-500"></i> <span>Nombre total de matches</span>
                    </h2>
                    <p class="text-4xl font-bold text-center mt-2 text-green-600">{{ $totalGames }}</p>
                </div>
            </div>
            <div class="p-6 bg-yellow-200 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-yellow-600 flex items-center">
                        <i class="fas fa-trophy text-5xl mr-4 text-yellow-500"></i> <span>Nombre total d'activités</span>
                    </h2>
                    <p class="text-4xl font-bold text-center mt-2 text-yellow-600">{{ $totalActivities }}</p>
                </div>
            </div>
        </div>

        <!-- Graphiques sur la même ligne -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Diagramme en barres -->
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Répartition des activités ({{ $selectedYear }})</h2>
                <div class="relative" style="height: 350px; width: 100%; margin: 0 auto;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Diagramme circulaire -->
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Pourcentage de participants par activité</h2>
                <div class="relative" style="height: 350px; width: 100%; margin: 0 auto;">
                    <canvas id="participantsChart"></canvas>
                </div>
            </div>
        </div>

        <script>
            // Diagramme en barres
            const activityCtx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(activityCtx, {
                type: 'bar',
                data: {
                    labels: @json($activityStats->pluck('name')),
                    datasets: [{
                        label: 'Nombre de matches',
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

            // Diagramme circulaire
            const participantsCtx = document.getElementById('participantsChart').getContext('2d');
            const participantsChart = new Chart(participantsCtx, {
                type: 'pie',
                data: {
                    labels: @json($participantStats->pluck('name')),
                    datasets: [{
                        label: 'Participants',
                        data: @json($participantStats->pluck('participants')),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const data = tooltipItem.dataset.data;
                                    const total = data.reduce((sum, value) => sum + value, 0);
                                    const value = data[tooltipItem.dataIndex];
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return `${tooltipItem.label}: ${value} (${percentage}%)`;
                                }
                            }
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                const data = ctx.chart.data.datasets[0].data;
                                const total = data.reduce((sum, value) => sum + value, 0);
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${percentage}%`;
                            },
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ajoutez le plugin ici
            });
        </script>
    @endsection
