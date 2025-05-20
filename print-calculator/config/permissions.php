<?php
// permissions.php

return [
    'roles' => [
        'admin' => [
            'permissions' => [
                'manage_users',
                'manage_materials',
                'manage_formats',
                'manage_finishings',
                'view_reports',
                'generate_reports',
                'access_dashboard',
                'update_settings',
            ],
        ],
        'operator' => [
            'permissions' => [
                'manage_materials',
                'manage_formats',
                'manage_finishings',
                'view_reports',
                'access_dashboard',
            ],
        ],
    ],
    'default_role' => 'operator',
];