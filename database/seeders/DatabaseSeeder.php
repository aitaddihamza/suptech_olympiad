<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nom' => 'suptech_admin',
            'prenom' => 'admin',
            'role' => 'admin',
            'email' => 'suptech_admin@suptech-sante.ma',
        ]);
        User::factory()->create([
            'nom' => 'ait addi',
            'prenom' => 'hamza',
            'role' => 'participant',
            'email' => 'hamza@suptech-sante.ma',
        ]);

        // Seed activities first
        $this->call(ActivitySeeder::class);

        // Now, seed users (if needed) or games after activities are seeded
        $this->call(UserSeeder::class);  // This could be your User seeder if you have it
        $this->call(GameSeeder::class);
    }
}
