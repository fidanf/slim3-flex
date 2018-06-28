<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Session\Flash;
use App\Views\View;
use Slim\Http\Request;
use Valitron\Validator;

abstract class Controller
{
    protected $view;

    protected $flash;
    
    public function __construct(View $view, Flash $flash)
    {
        $this->view = $view;
        $this->flash = $flash;
    }

    public function validate(Request $request, array $rules)
    {
        $validator = new Validator($request->getParsedBody());

        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            throw new ValidationException(
                $request,
                $validator->errors()
            );
        }

        return $request->getParsedBody();
    }
}