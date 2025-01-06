<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['ping pong', 'chess']),
            'date_debut' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'date_fin' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
