<?php

namespace App\Exceptions;

use Exception;
use Slim\Http\Request;

class ValidationException extends Exception
{
    protected $request;

    protected $errors;
    
    public function __construct(Request $request, array $errors)
    {
        $this->errors = $errors;
        $this->request = $request;
    }

    public function getPath()
    {
        return $this->request->getUri()->getPath();
    }

    public function getOldInput()
    {
        return $this->request->getParsedBody();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}