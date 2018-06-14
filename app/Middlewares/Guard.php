<?php

namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class Csrf
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        // TODO Csrf
    }
}