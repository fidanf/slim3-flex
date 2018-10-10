<?php

namespace App\Middlewares;

use App\Auth\Auth;
use Exception;

class AuthenticateFromCookie
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke($request, $response, callable $next)
    {
        if ($this->auth->check()) {
            return $next($request, $response);
        }

        if ($this->auth->hasRecaller()) {
            try {
                $this->auth->setUserFromCookie();
            } catch (Exception $e) {
                $this->auth->logout();
            }
        }

        return $next($request, $response);
    }
}
