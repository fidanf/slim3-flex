<?php

namespace App\Middlewares;

use App\Auth\Auth;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;

class Authenticated
{
    protected $auth;

    protected $router;

    public function __construct(Auth $auth, Router $router)
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        if (!$this->auth->check()) {
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }

        return $next($request, $response);
    }
}
