<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the admin user
        User::factory()->create([
            'nom' => 'suptech_admin',
            'prenom' => 'admin',
            'role' => 'admin',
            'email' => 'suptech_admin@suptech-sante.ma',
        ]);


        $this->call(ActivitySeeder::class);

        // Now, seed users (and attach activities)
        $this->call(UserSeeder::class);

        // Finally, seed games
        $this->call(GameSeeder::class);
    }
}
