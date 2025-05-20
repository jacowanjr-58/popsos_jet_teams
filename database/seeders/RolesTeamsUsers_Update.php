<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTeamsUsers_Update extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_user', 'guard_name' => 'web']);
        $corporateAdmin = Role::firstOrCreate(['name' => 'corporate_admin', 'guard_name' => 'web']);

        $superAdmin->givePermissionTo(Permission::all());

        $corporateAdmin->givePermissionTo([
            'user.view',
            'user.manage',
            'role.approve',
            'franchise.create',
            'franchise.update',
            'franchise.view',
        ]);
    }
}
