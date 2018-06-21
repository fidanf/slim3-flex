<?php

namespace App\Exceptions;

use Exception;
use ReflectionClass;
use App\Views\View;
use App\Session\SessionInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ExceptionHandler
{
    protected $session;

    protected $view;

    protected $request;

    protected $reponse;

    public function __construct(SessionInterface $session, View $view)
    {
        $this->session = $session;
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, Exception $exception)
    {
        $shortName = $this->getClassShortName($exception);
        $this->request = $request;
        $this->response = $response;

        if (method_exists($this, $handler = "handle{$shortName}")) {
            return $this->{$handler}($exception);
        } 

        return $this->unhandledException($exception);
    }

    private function getClassShortName(Exception $e)
    {
        return (new ReflectionClass($e))->getShortName();
    }

    private function handleValidationException(Exception $e)
    {
         $this->session->set([
            'errors' => $e->getErrors(),
            'old' => $e->getOldInput(),
        ]);

        return $this->response->withRedirect($e->getPath());
    }

    protected function handleCsrfTokenException(Exception $e)
    {
        return $this->view->render($this->response, 'errors/csrf.twig');
    }

    private function unhandledException(Exception $e)
    {
        throw $e;
    }
}