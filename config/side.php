<?php

return [
    [
        'section' => 'لوحة تحكم المدير',
        'items' => [
            [
                'label' => 'مركز القيادة',
                'icon' => 'fas fa-th-large',
                'route' => 'admin.dashboard',
                // 'ability' => 'view-dashboard',
                'active_pattern' => 'admin.dashboard',
            ]
        ]
    ],
    [
        'section' => 'العمليات الأساسية',
        'items' => [
            [
                'label' => 'إدارة الموظفين',
                'icon' => 'fas fa-user-tie',
                'route' => 'employees.index',
                'ability' => 'employee.view',
                'active_pattern' => 'employees.*',
            ],
            [
                'label' => 'إدارة اللاعبين',
                'icon' => 'fas fa-users',
                'route' => 'players.index',
                'ability' => 'player.view',
                'active_pattern' => 'players.*',
            ],
            [
                'label' => 'التقارير المالية',
                'icon' => 'fas fa-chart-line',
                'route' => 'admin.subscriptions.index',
                'ability' => 'financials.view',
                'active_pattern' => 'admin.subscriptions.*',
            ]
        ]
    ],
    [
        'section' => 'الإعدادات والأمان',
        'items' => [
            [
                'label' => 'إدارة الأدوار والصلاحيات',
                'icon' => 'fas fa-user-shield',
                'route' => 'admin.roles',
                'active_pattern' => 'admin.roles*',
                'ability' => 'role.view',
            ],
            [
                'label' => 'نظام الأمان المتقدم',
                'icon' => 'fas fa-lock',
                'route' => 'admin.2fa',
                // 'ability' => '2fa.view',
                'active_pattern' => 'admin.2fa.*',
            ],

                [
                    'label' => 'إدارة المدراء',
                    'icon' => 'fas fa-cogs',
                    'route' => 'admins.index',
                    'ability' => 'admin.view',
                    'active_pattern' => 'admins.*',
                ]
        ]
    ]
];