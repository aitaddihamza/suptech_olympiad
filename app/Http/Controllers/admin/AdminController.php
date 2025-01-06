<?php

namespace App\Http\Controllers\admin;

use App\Models\Activity;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }
    # participnat crud
    public function participants(Request $request)
    {
        // Get filter inputs
        $inputs = $request->only('prenom', 'nom', 'activity');

        // Start the query to get participants
        $query = User::query()->where('role', '=', 'participant');

        // Apply filters based on the request
        if ($request->filled('prenom')) {
            $query->where('prenom', 'like', '%' . $request->prenom . '%');
        }

        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }

        if ($request->filled('activity') && $request->activity !== 'tous') {
            // Assuming you have a relationship between User and Activity
            $request->activity = $request->activity == 'ping_pong' ? 'ping pong' : 'chess';
            $activity = Activity::where('name', $request->activity)->first();
            if ($activity) {
                $query->whereHas('activities', function ($query) use ($activity) {
                    $query->where('activity_id', $activity->id);
                });
            }
        }
        // Paginate the results and order by the latest update

        $participants = $query->orderBy('updated_at', 'desc')->paginate(10);

        // Pass the participants and filter inputs to the view
        return view("admin.participant.index", compact('participants', 'inputs'));
    }

    # games crud
    public function games(Request $request)
    {
        // Get the selected activity from the request, defaulting to 'tous' (all)
        $activityName = $request->input('activity', 'tous');

        // Get the activity ID based on the selected activity name
        if ($activityName != 'tous') {
            $activity = Activity::where('name', $activityName)->first();

            // Check if the activity exists
            if (!$activity) {
                // Handle the case where the activity does not exist
                return redirect()->route('games.index')->with('error', 'Activity not found.');
            }

            // Fetch the games associated with the selected activity
            $games = Game::where('activity_id', $activity->id)
                        ->orderBy('updated_at', 'desc')
                        ->paginate(5);
        } else {
            // Fetch all games if no activity is selected
            $games = Game::orderBy('updated_at', 'desc')->paginate(5);
        }

        // Pass the games and the selected activity name to the view
        return view('admin.game.index', compact('games', 'activityName'));
    }

    public function create_game()
    {
        $game = new Game();
        $players = User::query()->where('role', '=', 'participant')->orderBy('updated_at', 'desc')->get();
        return view('admin.game.form', compact('game', 'players'));
    }

    public function store_game(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'activity' => 'required|in:ping_pong,chess',
            'player1_id' => 'required|exists:users,id',
            'player2_id' => 'required|exists:users,id',
            'score1' => 'nullable|integer',
            'score2' => 'nullable|integer',
            'schedule_date' => 'required|date',
        ]);

        // Create the new game
        $game = new Game();
        $validated['activity'] = $validated['activity'] == 'ping_pong' ? 'ping pong' : 'chess';
        $game->activity_id = Activity::where('name', $validated['activity'])->first()->id;
        $game->player1_id = $validated['player1_id'];
        $game->player2_id = $validated['player2_id'];
        $game->score1 = $validated['score1'] ?? null;
        $game->score2 = $validated['score2'] ?? null;
        $game->schedule_date = $validated['schedule_date'];
        $game->save();

        // Attach participants to the game in the pivot table
        $game->participants()->attach([
            $validated['player1_id'],
            $validated['player2_id']
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.game.index')->with('success', 'Game created successfully!');
    }

    public function edit_game(Game $game)
    {
        // Get the list of players for the form
        $players = User::where('role', 'participant')->get();

        return view('admin.game.form', compact('game', 'players'));
    }

    public function update_game(Request $request, Game $game)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'activity' => 'required|in:ping_pong,chess',
            'player1_id' => 'required|exists:users,id',
            'player2_id' => 'required|exists:users,id',
            'score1' => 'nullable|integer',
            'score2' => 'nullable|integer',
            'schedule_date' => 'required|date',
        ]);

        // Update the game attributes
        $validated['activity'] = $validated['activity'] == 'ping_pong' ? 'ping pong' : 'chess';
        $game->activity_id = Activity::where('name', $validated['activity'])->first()->id;
        $game->player1_id = $validated['player1_id'];
        $game->player2_id = $validated['player2_id'];
        $game->score1 = $validated['score1'] ?? null;
        $game->score2 = $validated['score2'] ?? null;
        $game->schedule_date = $validated['schedule_date'];
        $game->save();

        // Synchronize participants in the pivot table
        $game->participants()->sync([
            $validated['player1_id'],
            $validated['player2_id']
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.game.index')->with('success', 'Game updated successfully!');
    }
    public function destroy_game(Game $game)
    {
        $game->delete();
        return to_route('admin.game.index')->with('warning', "le jeu a bien été supprimé !");
    }


}
