<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            'Inventory' => [
                'inventory.view',
                'inventory.create',
                'inventory.update',
                'inventory.delete',
                'inventory.transfer',
                'inventory.adjust',
            ],
            'Invoicing' => [
                'invoice.view',
                'invoice.create',
                'invoice.send',
                'invoice.approve',
                'invoice.delete',
            ],
            'POS' => [
                'pos.view',
                'pos.process_sale',
                'pos.refund',
                'pos.override_price',
            ],
            'Events' => [
                'event.view',
                'event.create',
                'event.update',
                'event.delete',
                'event.assign_staff',
            ],
            'Users & Roles' => [
                'user.view',
                'user.manage',
                'role.assign',
                'role.request',
                'role.approve',
            ],
            'Reporting' => [
                'report.view_sales',
                'report.view_inventory',
                'report.view_events',
                'report.export',
            ],
            'Settings' => [
                'settings.view',
                'settings.update',
                'settings.manage_team',
            ],
        ];

        foreach ($groups as $group => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }
    }
}
