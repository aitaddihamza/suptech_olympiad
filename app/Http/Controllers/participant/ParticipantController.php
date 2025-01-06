<?php

namespace App\Http\Controllers\participant;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParticipantController extends Controller
{
    public function index()
    {
        return view("participant.dashboard");
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

}
