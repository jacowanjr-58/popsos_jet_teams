<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;

class RolesTeamsUsers extends Seeder
{
    public function run(): void
    {
        $northPop = Team::factory()->create(['name' => 'North Pop']);
        $southPop = Team::factory()->create(['name' => 'South Pop']);

        $users = [
            [
                'name' => 'Alice Super',
                'email' => 'super@example.com',
                'role' => 'super_user',
                'teams' => [$northPop, $southPop],
            ],
            [
                'name' => 'Bob Corp',
                'email' => 'corp@example.com',
                'role' => 'corporate_admin',
                'teams' => [$northPop],
            ],
            [
                'name' => 'Fran Owner',
                'email' => 'owner@example.com',
                'role' => 'franchise_admin',
                'teams' => [$northPop],
            ],
            [
                'name' => 'Manny Manager',
                'email' => 'manager@example.com',
                'role' => 'franchise_manager',
                'teams' => [$southPop],
            ],
            [
                'name' => 'Sally Staff',
                'email' => 'staff@example.com',
                'role' => 'franchise_staff',
                'teams' => [$northPop],
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            foreach ($data['teams'] as $team) {
                $user->teams()->attach($team->id);
            }

            $user->assignRole($data['role']);
        }
    }
}
