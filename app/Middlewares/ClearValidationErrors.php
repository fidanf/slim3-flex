<?php

namespace App\Middlewares;

use App\Session\SessionInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ClearValidationErrors
{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $next = $next($request, $response);

        $this->session->clear('errors', 'old');

        return $next;
    }
}
