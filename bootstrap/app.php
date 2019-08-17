<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::create(base_path('/'));
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    die($e);
}

require base_path('bootstrap/container.php');

$app = new Slim\App($container);

require base_path('bootstrap/middleware.php');

require base_path('routes/web.php');
