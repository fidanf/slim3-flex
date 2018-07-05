<?php

namespace App\Providers;

use App\Security\Bcrypt;
use App\Security\HasherInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class HashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        HasherInterface::class
    ];

    public function register()
    {
        $this->getContainer()->share(HasherInterface::class, function () {
            return new Bcrypt();
        });
    }
}
