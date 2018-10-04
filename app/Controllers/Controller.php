<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use Slim\Http\Request;
use Valitron\Validator;

abstract class Controller
{
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