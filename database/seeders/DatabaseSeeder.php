<?php

namespace Database\Seeders;

use App\Models\User;
use database\PermissionSeeder;
use Database\Seeders\PermissionSeeder as SeedersPermissionSeeder;
use Database\Seeders\roles_teams_users as roles_teams_users;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        SeedersPermissionSeeder::class,
        SeedRolesTeamsUsers::class,
        // Add other seeders here
    ]);


    }
}
