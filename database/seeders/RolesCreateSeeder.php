<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesCreateSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super_user',
            'corporate_admin',
            'franchise_admin',
            'franchise_manager',
            'franchise_staff',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
