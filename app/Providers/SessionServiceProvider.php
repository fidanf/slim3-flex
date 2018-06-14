<?php

namespace App\Providers;

use App\Session\Session;
use App\Session\SessionInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class SessionServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        SessionInterface::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(SessionInterface::class, function () {
            return new Session;
        });
    }
}
