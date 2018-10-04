<?php

namespace App\Providers;

use App\Auth\Hashing\Bcrypt;
use App\Auth\Hashing\HasherInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class HashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        HasherInterface::class
    ];

    public function register()
    {
        $this->getContainer()->share(HasherInterface::class, function () {
            return new Bcrypt;
        });
    }
}
