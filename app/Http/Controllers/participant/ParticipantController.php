<?php

namespace App\Http\Controllers\participant;

use App\Models\Activity;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        // Get the current user's ID
        $user = auth()->user();

        // Fetch user-specific stats
        $gamesPlayed = $user->games->count();
        $upcomingGames = $user->games()->where('schedule_date', '>', now())->count();
        $completedGames = $user->games()->whereNotNull('score1')->whereNotNull('score2')->count();

        // Get the current year
        $currentYear = now()->year;

        // Fetch statistics for the participant
        $activityStats = Activity::with(['games' => function ($query) use ($user, $currentYear) {
            $query->whereHas('participants', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereYear('created_at', $currentYear);
        }])->get()->map(function ($activity) {
            return [
                'name' => $activity->name,
                'games' => $activity->games->count(),
            ];
        });

        // Pass data to the view
        return view('participant.dashboard', [
            'user' => $user,
            'gamesPlayed' => $gamesPlayed,
            'upcomingGames' => $upcomingGames,
            'completedGames' => $completedGames,
            'activityStats' => $activityStats,
        ]);
    }


    public function games()
    {
        $user = auth()->user();

        // Fetch all games associated with this participant
        $games = $user->games()->orderBy('schedule_date', 'desc')->get();

        return view('participant.games', compact('games'));
    }

    public function activities()
    {
        $user = auth()->user(); // Participant connecté

        // Récupérer toutes les activités
        $allActivities = Activity::all();

        // Récupérer les activités auxquelles l'utilisateur participe
        $participatedActivities = $user->activities;

        // Identifier les activités auxquelles l'utilisateur ne participe pas
        $nonParticipatedActivities = $allActivities->diff($participatedActivities);

        return view('participant.activities', compact('participatedActivities', 'nonParticipatedActivities'));
    }

    public function participate(Activity $activity)
    {
        $user = Auth::user();
        $user->activities()->attach($activity->id);
        return to_route('participant.activities')->with('success', 'Vous participez maintenant à cette activité');

    }
    public function cancel(Activity $activity)
    {
        $user = Auth::user();
        $user->activities()->detach($activity->id);
        return to_route('participant.activities')->with('success', 'Vous avez annulé votre participation à cette activité');

    }
}
