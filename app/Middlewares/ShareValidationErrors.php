<?php

namespace App\Middlewares;

use App\Views\View;
use App\Session\SessionInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ShareValidationErrors
{
    protected $view;

    protected $session;

    public function __construct(View $view, SessionInterface $session)
    {
        $this->view = $view;
        $this->session = $session;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {
        $this->view->share([
            'errors' => $this->session->get('errors', []),
            'old' => $this->session->get('old', []),
        ]);

        return $next($request, $response);
    }
}
