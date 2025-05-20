<?php

// config/permission-groups.php

return [
    'Inventory' => [
        'icon' => '📦',
        'permissions' => [
            'inventory.view',
            'inventory.create',
            'inventory.update',
            'inventory.delete',
            'inventory.transfer',
            'inventory.adjust',
        ],
    ],
    'Invoicing' => [
        'icon' => '🢾',
        'permissions' => [
            'invoice.view',
            'invoice.create',
            'invoice.send',
            'invoice.approve',
            'invoice.delete',
        ],
    ],
    'POS' => [
        'icon' => '💳',
        'permissions' => [
            'pos.view',
            'pos.process_sale',
            'pos.refund',
            'pos.override_price',
        ],
    ],
    'Events' => [
        'icon' => '📅',
        'permissions' => [
            'event.view',
            'event.create',
            'event.update',
            'event.delete',
            'event.assign_staff',
        ],
    ],
    'Users & Roles' => [
        'icon' => '👥',
        'permissions' => [
            'user.view',
            'user.manage',
            'role.assign',
            'role.request',
            'role.approve',
        ],
    ],
    'Reporting' => [
        'icon' => '🫮',
        'permissions' => [
            'report.view_sales',
            'report.view_inventory',
            'report.view_events',
            'report.export',
        ],
    ],
    'Settings' => [
        'icon' => '🚰',
        'permissions' => [
            'settings.view',
            'settings.update',
            'settings.manage_team',
        ],
    ],
];
