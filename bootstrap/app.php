<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(base_path()))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    die($e);
}

require base_path('bootstrap/container.php');

$app = new Slim\App($container);

require base_path('bootstrap/middleware.php');

require base_path('routes/web.php');
