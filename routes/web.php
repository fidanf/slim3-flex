<?php

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('home');
$app->post('/', App\Controllers\HomeController::class . ':newAction');

$app->group('/auth', function() {
   $this->get('/login', App\Controllers\Auth\LoginController::class . ':index')->setName('auth.login');
   $this->post('/login', App\Controllers\Auth\LoginController::class . ':login');
});