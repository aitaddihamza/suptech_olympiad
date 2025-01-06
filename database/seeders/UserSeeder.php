<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'nom' => 'suptech_admin',
            'prenom' => 'admin',
            'role' => 'admin',
            'email' => 'suptech_admin@suptech-sante.ma',
            'password' => bcrypt('password'), // Default password for testing
        ]);

        // Create participant users
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            // Attach all activities to each user
            $activities = Activity::all(); // Get all activities
            $user->activities()->attach($activities); // Attach all activities to the user
        }
    }
}
