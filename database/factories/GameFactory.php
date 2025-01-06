<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Activity;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        // Ensure that there are enough participants
        $player1 = User::where('role', 'participant')->inRandomOrder()->first();
        $player2 = User::where('role', 'participant')->inRandomOrder()->first();

        // Ensure both players are valid and different
        while (!$player1 || !$player2 || $player1->id == $player2->id) {
            $player1 = User::where('role', 'participant')->inRandomOrder()->first();
            $player2 = User::where('role', 'participant')->inRandomOrder()->first();
        }

        // Ensure there is at least one activity available
        $activity = Activity::inRandomOrder()->first();
        if (!$activity) {
            throw new \Exception("No activities found.");
        }

        return [
            'player1_id' => $player1->id,
            'player2_id' => $player2->id,
            'activity_id' => $activity->id,
            'schedule_date' => $this->faker->dateTimeBetween('-365 days', '-30 days'),
            'score1' => $this->faker->numberBetween(0, 10),
            'score2' => $this->faker->numberBetween(0, 10),
        ];
    }
}
