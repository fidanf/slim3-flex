<?php 

return [
    'settings' => [
        'httpVersion' => '1.1',
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => getenv('APP_ENV') === 'dev',
    ],
    'middlewares' => [
        //
    ],
    'providers' => [
        //
    ]
];