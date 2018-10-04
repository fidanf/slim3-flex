<?php

namespace App\Middlewares;

use App\Auth\Auth;
use Slim\Http\Request;
use Slim\Http\Response;

class Guest
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        if ($this->auth->check()) {
            return $response->withRedirect('/');
        }

        return $next($request, $response);
    }
}
