<?php

return [
    [
        'section' => 'لوحة تحكم المدير',
        'items' => [
            [
                'label' => 'مركز القيادة',
                'icon' => 'fas fa-th-large',
                'route' => 'admin.dashboard',
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
            ],
            [
                'label' => 'إدارة اللاعبين',
                'icon' => 'fas fa-users',
                'route' => 'players.index',
            ],
            [
                'label' => 'التقارير المالية',
                'icon' => 'fas fa-chart-line',
                'route' => 'admin.financials.index',
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
            ],
            [
                'label' => 'نظام الأمان المتقدم',
                'icon' => 'fas fa-lock',
                'route' => 'admin.2fa',
            ],

                [
                    'label' => 'إدارة المدراء',
                    'icon' => 'fas fa-cogs',
                    'route' => 'admins.index',
                ]
        ]
    ]
];