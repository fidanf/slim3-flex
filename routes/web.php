<?php

$app->get('/hello/{name}', function (Slim\Http\Request $request, Slim\Http\Response $response, $name) {
    return $response->write('Hello, ' . $name);
})->setName('hello');

$app->get('/', App\Controllers\HomeController::class . ':index');