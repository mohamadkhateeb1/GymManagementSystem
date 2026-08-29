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
                'label' => 'حضور الموظفين',
                'icon' => 'fas fa-calendar-check',
                'route' => 'admin.attendance.employees.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'admin.attendance.employees.*',
            ],
            [
                'label' => 'حضور اللاعبين',
                'icon' => 'fas fa-user-clock',
                'route' => 'admin.attendance.players.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'admin.attendance.players.*',
            ]
        ]
    ],
    [
        'section' => 'الإدارة المالية',
        'items' => [
            [
                'label' => 'الاشتراكات',
                'icon' => 'fas fa-id-card',
                'route' => 'subscriptions.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'subscriptions.*',
            ],
            [
                'label' => 'الباقات والأسعار',
                'icon' => 'fas fa-tags',
                'route' => 'admin.plan-types.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'admin.plan-types.*',
            ],
            [
                'label' => 'التقارير المالية',
                'icon' => 'fas fa-file-invoice-dollar',
                'route' => 'admin.financial-reports.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'admin.financial-reports.*',
            ],
            [
                'label' => 'أرشيف الإدارة المالية',
                'icon' => 'fas fa-box-archive',
                'route' => 'admin.financial-archive.index',
                // 'ability' => 'financials.view',
                'active_pattern' => 'admin.financial-archive.*',
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
                    'label' => 'مسؤولين النظام',
                    'icon' => 'fas fa-cogs',
                    'route' => 'admins.index',
                    'ability' => 'admin.view',
                    'active_pattern' => 'admins.*',
                ]
        ]
    ]
];