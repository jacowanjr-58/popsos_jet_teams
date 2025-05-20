<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;


class RoleRequestSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 dummy franchisees if not already present
        $franchise1 = Team::firstOrCreate(['name' => 'Rome Pop']);
        $franchise2 = Team::firstOrCreate(['name' => 'Florida Pop']);
        $franchise3 = Team::firstOrCreate(['name' => 'Texas Pop']);

        // Create users with no role yet
        $users = [
            [
                'name' => 'Alice Manager',
                'email' => 'alice@example.com',
                'desired_role' => 'franchise_manager',
                'franchise_ids' => [$franchise1->id],
            ],
            [
                'name' => 'Bob Admin Multi',
                'email' => 'bob@example.com',
                'desired_role' => 'franchise_admin',
                'franchise_ids' => [$franchise1->id, $franchise2->id],
            ],
            [
                'name' => 'Carol Staff',
                'email' => 'carol@example.com',
                'desired_role' => 'franchise_staff',
                'franchise_ids' => [$franchise3->id],
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'password' => Hash::make('password')]
            );

            foreach ($userData['franchise_ids'] as $fid) {
                RoleRequest::firstOrCreate([
                    'user_id' => $user->id,
                    'desired_role' => $userData['desired_role'],
                    'franchise_ids' => $fid,
                    'status' => 'pending',
                ]);
            }
        }
    }
}
