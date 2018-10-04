<?php

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('home');
$app->post('/', App\Controllers\HomeController::class . ':newAction');

$app->group('', function() {
    $this->get('/profile', App\Controllers\ProfileController::class . ':index')->setName('profile');
    $this->post('/auth/logout', App\Controllers\Auth\LogoutController::class . ':logout')->setName('auth.logout');
})->add(new App\Middlewares\Authenticated(
        $container->get(App\Auth\Auth::class),
        $container->get('router')
    )
);

$app->group('/auth', function() {
    $this->get('/login', App\Controllers\Auth\LoginController::class . ':index')->setName('auth.login');
    $this->post('/login', App\Controllers\Auth\LoginController::class . ':login');
    $this->get('/register', App\Controllers\Auth\RegisterController::class . ':index')->setName('auth.register');
    $this->post('/register', App\Controllers\Auth\RegisterController::class . ':register');
})->add(new App\Middlewares\Guest($container->get(App\Auth\Auth::class)));