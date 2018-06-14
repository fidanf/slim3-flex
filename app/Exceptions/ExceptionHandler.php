<?php

namespace App\Exceptions;

use Exception;
use ReflectionClass;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Session\SessionInterface;

class ExceptionHandler
{
    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke(Request $request, Response $response, Exception $exception)
    {
        $shortName = $this->getClassShortName($exception);

        if (method_exists($this, $handler = "handle{$shortName}")) {
            return $this->{$handler}($request, $response, $exception);
        } 

        return $this->unhandledException($exception);
    }

    private function getClassShortName(Exception $e)
    {
        return (new ReflectionClass($e))->getShortName();
    }

    private function handleValidationException(Request $request, Response $response, Exception $e)
    {
         $this->session->set([
            'errors' => $e->getErrors(),
            'old' => $e->getOldInput(),
        ]);

        return $response->withRedirect($e->getPath());
    }

    private function unhandledException(Exception $e)
    {
        throw $e;
    }
}