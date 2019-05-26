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
        'App\Middlewares\Authenticate',
        'App\Middlewares\CsrfGuard',
        'App\Middlewares\AuthenticateFromCookie',
    ],
    'providers' => [
        'App\Providers\ViewServiceProvider',
        'App\Providers\CookieServiceProvider',
        'App\Providers\AuthServiceProvider',
        'App\Providers\DatabaseServiceProvider',
        'App\Providers\SessionServiceProvider',
        'App\Providers\CsrfServiceProvider',
        'App\Providers\HashServiceProvider',
        'App\Providers\FlashServiceProvider',
        'App\Providers\ValidationServiceProvider',
        'App\Providers\ViewShareServiceProvider',
        'App\Providers\PaginationServiceProvider',
        'App\Providers\MailServiceProvider',
    ]
];