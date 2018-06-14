<?php

namespace App\Controllers;

use App\Views\View;
use Slim\Http\Request;
use Valitron\Validator;
use App\Exceptions\ValidationException;

abstract class Controller
{
    protected $view;
    
    public function __construct(View $view)
    {
        $this->view = $view;
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