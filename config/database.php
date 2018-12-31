<?php

return [
    'db' => [
        'driver' => env('DB_DRIVER'),
        'host' => env('DB_HOST'),
        'port' => env('DB_PORT'),
        'database' => env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => ''
    ],

    'migrations' => [
        'default_migration_table' => 'migrations',
        'migration_base_class' => 'App\Support\Migrations\Migration',
        'paths' => [
            'migrations' => base_path('database/migrations'),
            'seeds' => base_path('database/seeds')
        ],
        'templates' => [
            'file' => base_path('app/Support/Migrations/Migration.stub')
        ]
    ]
];