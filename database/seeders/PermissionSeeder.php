<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

   public function run(): void
    {
        foreach (config('permission_groups') as $group => $data) {
            foreach ($data['permissions'] as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            }
        }

    }
}
