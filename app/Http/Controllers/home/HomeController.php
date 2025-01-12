<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function matches(Request $request)
    {
        // Récupérer les filtres
        $searchTerm = $request->input('search');
        $searchDate = $request->input('date');

        // Query pour les matchs à venir
        $upcomingMatches = Game::with('player1', 'player2', 'activity')
            ->where('schedule_date', '>', now())
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereHas('player1', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('prenom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('nom', 'like', '%' . $searchTerm . '%');
                    })->orWhereHas('player2', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('prenom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('nom', 'like', '%' . $searchTerm . '%');
                    });
                });
            })
            ->when($searchDate, function ($query, $searchDate) {
                $query->whereDate('schedule_date', $searchDate);
            })
            ->orderBy('schedule_date', 'asc')
            ->paginate(10);

        // Query pour les matchs passés
        $pastMatches = Game::with('player1', 'player2', 'activity')
            ->where('schedule_date', '<', now())
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereHas('player1', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('prenom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('nom', 'like', '%' . $searchTerm . '%');
                    })->orWhereHas('player2', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('prenom', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('nom', 'like', '%' . $searchTerm . '%');
                    });
                });
            })
            ->when($searchDate, function ($query, $searchDate) {
                $query->whereDate('schedule_date', $searchDate);
            })
            ->orderBy('schedule_date', 'desc')
            ->paginate(10);

        return view('home.matches', compact('upcomingMatches', 'pastMatches'));
    }

    public function classements(Request $request)
    {
        // Récupérer toutes les activités disponibles
        $activities = Activity::all();

        // Activité par défaut (ping pong)
        $selectedActivity = $request->input('activity', 'chess');

        // Vérifier si l'activité sélectionnée existe dans la table
        $activity = Activity::where('name', $selectedActivity)->firstOrFail();

        // Récupérer l'année sélectionnée ou utiliser l'année actuelle
        $selectedYear = $request->input('year', now()->year);

        // Générer les années disponibles (de 2024 à l'année actuelle)
        $years = range(date('Y'), 2024);

        // Démarrer la requête pour récupérer les utilisateurs participants
        $usersQuery = User::where('role', 'participant')
            ->whereHas('games', function ($query) use ($activity, $selectedYear) {
                $query->where('activity_id', $activity->id)
                      ->whereYear('games.created_at', $selectedYear); // Explicit table reference
            })
            ->with(['games' => function ($query) use ($activity, $selectedYear) {
                $query->where('activity_id', $activity->id)
                      ->whereYear('games.created_at', $selectedYear); // Explicit table reference
            }]);

        // Appliquer le filtrage par nom ou prénom si spécifié
        if ($request->filled('prenom')) {
            $usersQuery->where('prenom', 'like', '%' . $request->prenom . '%');
        }

        if ($request->filled('nom')) {
            $usersQuery->where('nom', 'like', '%' . $request->nom . '%');
        }

        // Récupérer les utilisateurs et calculer les scores
        $users = $usersQuery->get()->map(function ($user) use ($activity) {
            return [
                'user' => $user,
                'activity_name' => $activity->name,
                'total_score' => $user->games->sum(function ($game) use ($user) {
                    return $game->player1_id === $user->id ? $game->score1 : $game->score2;
                }),
                'wins' => $user->games->filter(function ($game) use ($user) {
                    return ($game->player1_id === $user->id && $game->score1 > $game->score2) ||
                           ($game->player2_id === $user->id && $game->score2 > $game->score1);
                })->count(),
                'losses' => $user->games->filter(function ($game) use ($user) {
                    return ($game->player1_id === $user->id && $game->score1 < $game->score2) ||
                           ($game->player2_id === $user->id && $game->score2 < $game->score1);
                })->count(),
                'ties' => $user->games->filter(function ($game) {
                    return $game->score1 !== null && $game->score2 !== null && $game->score1 === $game->score2;
                })->count(),
            ];
        });

        // Trier par score total et appliquer la pagination manuellement
        $sortedUsers = $users->sortByDesc('total_score')->values();

        // Pagination personnalisée
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedUsers = new LengthAwarePaginator(
            $sortedUsers->forPage($currentPage, $perPage),
            $sortedUsers->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Passer les données à la vue
        return view('home.classements', [
            'classements' => $paginatedUsers,
            'activities' => $activities,
            'selectedActivity' => $selectedActivity,
            'selectedYear' => $selectedYear,
            'years' => $years,
            'filters' => $request->only('nom', 'prenom', 'activity', 'year'),
        ]);
    }

}
