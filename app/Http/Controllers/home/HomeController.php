<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;
use App\Models\Activity;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function matches()
    {
        $upcomingMatches = Game::where('schedule_date', '>', now())
            ->with('player1', 'player2', 'activity')
            ->orderBy('schedule_date', 'asc')
            ->paginate(10);

        $pastMatches = Game::where('schedule_date', '<', now())
            ->with('player1', 'player2', 'activity')
            ->orderBy('schedule_date', 'desc')
            ->paginate(10);

        return view('home.matches', compact('upcomingMatches', 'pastMatches'));
    }

    public function classements(Request $request)
    {
        // Récupérer toutes les activités disponibles
        $activities = Activity::all();

        // Activité par défaut (ping pong)
        $selectedActivity = $request->input('activity', 'ping pong');

        // Vérifier si l'activité sélectionnée existe dans la table
        $activity = Activity::where('name', $selectedActivity)->firstOrFail();

        // Démarrer la requête pour récupérer les utilisateurs participants
        $usersQuery = User::where('role', 'participant')
            ->whereHas('games', function ($query) use ($activity) {
                $query->where('activity_id', $activity->id);
            })
            ->with(['games' => function ($query) use ($activity) {
                $query->where('activity_id', $activity->id);
            }]);

        // Appliquer le filtrage par nom ou prénom si spécifié
        if ($request->filled('prenom')) {
            $usersQuery->where('prenom', 'like', '%' . $request->prenom . '%');
        }

        if ($request->filled('nom')) {
            $usersQuery->where('nom', 'like', '%' . $request->nom . '%');
        }

        // Appliquer la pagination
        $paginatedUsers = $usersQuery->paginate(10);

        // Calculer les scores et statistiques pour chaque utilisateur
        $classements = $paginatedUsers->getCollection()->map(function ($user) use ($activity) {
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
                // Ignorer les égalités si aucun score n'existe
                'ties' => $user->games->filter(function ($game) {
                    return $game->score1 !== null && $game->score2 !== null && $game->score1 === $game->score2;
                })->count(),
            ];
        });

        // Remettre les résultats dans le paginator pour les liens de pagination
        $paginatedUsers->setCollection($classements);

        // Passer les données à la vue
        return view('home.classements', [
            'classements' => $paginatedUsers,
            'activities' => $activities,
            'selectedActivity' => $selectedActivity,
            'filters' => $request->only('nom', 'prenom', 'activity'),
        ]);
    }
}
