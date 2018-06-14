<?php 

return [
    'settings' => [
        'httpVersion' => '1.1',
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => env('APP_ENV') === 'dev',
    ],
    'middlewares' => [
        'App\Middlewares\ShareValidationErrors',
        'App\Middlewares\ClearValidationErrors',
    ],
    'providers' => [
        'App\Providers\ViewServiceProvider',
        'App\Providers\DatabaseServiceProvider',
        'App\Providers\SessionServiceProvider',
    ]
];