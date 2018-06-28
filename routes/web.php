<?php

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('home');
$app->post('/', App\Controllers\HomeController::class . ':newAction');