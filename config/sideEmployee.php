<?php


return [
    [
        'section' => 'لوحة الموظف',
        'items' => [
            [
                'label' => 'لوحة التحكم',
                'icon' => 'fas fa-gauge-high',
                'route' => 'employee.dashboard',
                'ability' => 'dashboard.view', // عامة للجميع
                'active_pattern' => 'employee.dashboard',
            ],
        ],
    ],
    [
        'section' => 'العمليات',
        'items' => [
            [
                'label' => 'متابعة اللاعبين',
                'icon' => 'fas fa-users',
                'route' => 'employee.monitoring',
                'ability' => 'player.view',
                'active_pattern' => 'employee.monitoring*',
            ],
            [
                'label' => 'بنك التدريب',
                'icon' => 'fas fa-dumbbell',
                'route' => 'employee.training.bank',
                'ability' => 'training_plan.view',
                'active_pattern' => 'employee.training.*',
            ],
            [
                'label' => 'بنك التغذية',
                'icon' => 'fas fa-utensils',
                'route' => 'employee.diet.bank',
                'ability' => 'diet_plan.view',
                'active_pattern' => 'employee.diet.*',
            ],
        ],
    ],
    [
        'section' => 'الحساب',
        'items' => [
            [
                'label' => 'الملف الشخصي',
                'icon' => 'fas fa-user',
                'route' => 'employee.profile.edit',
                'active_pattern' => 'employee.profile.*',
            ],
        ],
    ],
];