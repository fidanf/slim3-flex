<?php

namespace App\Middlewares;

use App\Exceptions\CsrfTokenException;
use App\Security\Csrf;
use Slim\Http\Request;
use Slim\Http\Response;

class CsrfGuard
{
    protected $csrf;

    protected $methods = ['POST', 'PUT', 'DELETE', 'PATCH'];

    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        if (!$this->requestRequiresProtection($request)) {
            return $next($request, $response);
        }

        if (!$this->csrf->tokenIsValid($this->getTokenFromRequest($request))) {
            throw new CsrfTokenException;
        }

        return $next($request, $response);
    }

    protected function getTokenFromRequest(Request $request)
    {
        return $request->getParsedBody()[$this->csrf->key()] ?? null;
    }

    protected function requestRequiresProtection(Request $request)
    {
        return in_array($request->getMethod(), $this->methods);
    }
}
