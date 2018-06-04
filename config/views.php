<?php 

return [
    'twig' => [
        'cache' => base_path('storage/cache'),
        'debug' => env('APP_ENV') === 'dev',
        'globals' => [
            'app_name' => env('APP_NAME')
        ],
        'extensions' => [
            //
        ],
    ],
];