<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        // Generate a few games and attach users
        Game::factory(10)->create()->each(function ($game) {
            // Attach both players to the game
            $game->participants()->attach([$game->player1_id, $game->player2_id]);
        });
    }
}
