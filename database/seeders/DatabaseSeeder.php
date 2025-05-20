<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RolesTeamsUsers;
use Database\Seeders\RoleRequestSeeder;
use Database\Seeders\RolesTeamsUsers_Update;
use Database\Seeders\RolesCreateSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
             RolesCreateSeeder::class,
            PermissionSeeder::class,
            RolesTeamsUsers::class,
            RolesTeamsUsers_Update::class,
            RoleRequestSeeder::class,
        ]);
    }
}
