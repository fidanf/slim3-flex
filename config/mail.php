<?php

return [
    'swiftmailer' => [
        'host' => getenv('SMTP_HOST'),
        'port' => getenv('SMTP_PORT'),
        'from' => [
            'name' => getenv('SMTP_FROM_NAME'),
            'address' => getenv('SMTP_FROM_ADDRESS')
        ],
        'username' => getenv('SMTP_USERNAME'),
        'password' => getenv('SMTP_PASSWORD'),
    ],
];