<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            // Add home location
            UserLocation::create([
                'user_id' => $user->id,
                'name' => 'Thuis',
                'address' => 'Amsterdam, Nederland',
                'latitude' => 52.3676,
                'longitude' => 4.9041,
                'is_primary' => true,
                'is_active' => true,
            ]);

            // Add work location
            UserLocation::create([
                'user_id' => $user->id,
                'name' => 'Werk',
                'address' => 'Rotterdam, Nederland',
                'latitude' => 51.9225,
                'longitude' => 4.4792,
                'is_primary' => false,
                'is_active' => true,
            ]);

            // Add gym location
            UserLocation::create([
                'user_id' => $user->id,
                'name' => 'Gym',
                'address' => 'Utrecht, Nederland',
                'latitude' => 52.0907,
                'longitude' => 5.1214,
                'is_primary' => false,
                'is_active' => true,
            ]);
        }
    }
}
