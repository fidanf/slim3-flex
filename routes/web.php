<?php

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('home');
$app->post('/', App\Controllers\HomeController::class . ':newAction');

$app->get('/profile', App\Controllers\ProfileController::class . ':index')->setName('profile');

$app->group('/auth', function() {
    $this->get('/login', App\Controllers\Auth\LoginController::class . ':index')->setName('auth.login');
    $this->post('/login', App\Controllers\Auth\LoginController::class . ':login');
    $this->get('/register', App\Controllers\Auth\RegisterController::class . ':index')->setName('auth.register');
    $this->post('/register', App\Controllers\Auth\RegisterController::class . ':register');
});