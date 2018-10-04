<?php

namespace App\Middlewares;

use App\Auth\Auth;
use Exception;
use Slim\Http\Request;
use Slim\Http\Response;

class Authenticate
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        if ($this->auth->hasUserInSession()) {
            try {
                $this->auth->setUserFromSession();
            } catch (Exception $e) {
                $this->auth->logout();
            }
        }

        return $next($request, $response);
    }
}
