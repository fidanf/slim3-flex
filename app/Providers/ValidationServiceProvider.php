<?php

namespace App\Providers;

use App\Validation\Rules\ExistRule;
use Valitron\Validator;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ValidationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Validator::addRule('exists', function ($field, $value, $params, $fields) {
           $rule = new ExistRule;
           return $rule->validate($field, $value, $params, $fields);
        }, 'is already in use.');
    }
}
