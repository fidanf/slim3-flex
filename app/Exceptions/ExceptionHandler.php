<?php

namespace App\Exceptions;

use Exception;
use ReflectionClass;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ExceptionHandler
{
    public function __invoke(Request $request, Response $response, Exception $exception)
    {
        $shortName = $this->getClassShortName($exception);

        if (method_exists($this, $handler = "handle{$shortName}")) {
            return $this->{$handler}($request, $response, $exception);
        } 

        return $this->unhandledException($exception);
    }

    protected function getClassShortName(Exception $e)
    {
        return (new ReflectionClass($e))->getShortName();
    }

    private function handleValidationException(Request $request, Response $response, Exception $e)
    {
        // dump($e->getErrors(), $e->getPath(), $e->getOldInput());

        // TODO
        // Store into Session
        // create ClearValidationErrors middleware
        return $response->withRedirect($e->getPath());
    }

    public function unhandledException(Exception $e)
    {
        throw $e;
    }
}