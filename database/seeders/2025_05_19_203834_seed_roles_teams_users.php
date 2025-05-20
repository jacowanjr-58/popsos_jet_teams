<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Team;
use Laravel\Jetstream\Jetstream;

class SeedRolesTeamsUsers extends Seeder
{
    public function run(): void
    {
        // Define roles
        $roles = [
            'super_user' => 'Super User',
            'corporate_admin' => 'Corporate',
            'franchise_admin' => 'Franchise Owner',
            'franchise_manager' => 'Franchise Manager',
            'franchise_staff' => 'Franchise Staff',
        ];

        // Create test franchises (Jetstream Teams)
        $northPop = Team::factory()->create(['name' => 'North Pop']);
        $southPop = Team::factory()->create(['name' => 'South Pop']);

        // Create users
        $users = [
            [
                'name' => 'Alice Super',
                'email' => 'super@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'super_user',
                'franchises' => [$northPop, $southPop],
            ],
            [
                'name' => 'Bob Corp',
                'email' => 'corp@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'corporate_admin',
                'franchises' => [$northPop],
            ],
            [
                'name' => 'Fran Owner',
                'email' => 'owner@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'franchise_admin',
                'franchises' => [$northPop],
            ],
            [
                'name' => 'Manny Manager',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => null,
                'role' => 'franchise_manager',
                'franchises' => [$southPop],
            ],
            [
                'name' => 'Sally Staff',
                'email' => 'staff@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'role' => 'franchise_staff',
                'franchises' => [$northPop],
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'email_verified_at' => $userData['email_verified_at'],
            ]);

            // Attach to team(s)
            foreach ($userData['franchises'] as $team) {
                $user->teams()->attach($team, ['role' => $userData['role']]);
            }

            // Assign role metadata (optional: store as relation or attribute)
            $user->role = $userData['role'];
            $user->save();
        }
    }
}
