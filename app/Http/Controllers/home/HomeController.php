<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;

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
}
