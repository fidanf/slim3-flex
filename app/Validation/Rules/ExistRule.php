<?php


namespace App\Validation\Rules;


class ExistRule
{
    public function validate($field, $value, $params, $fields)
    {
        $result = $params[0]::where($field, $value)->first();

        return $result === null;
    }
}