<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed some activities
        Activity::create([
            'name' => 'Chess',
            'date_debut' => '2025-01-01',
            'date_fin' => '2025-01-31',
        ]);

        Activity::create([
            'name' => 'Ping Pong',
            'date_debut' => '2025-01-01',
            'date_fin' => '2025-02-28',
        ]);

        // Add more activities as needed
    }
}
