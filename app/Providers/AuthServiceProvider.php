<?php

namespace App\Providers;

use App\Auth\Auth;
use App\Auth\Recaller;
use App\Auth\Hashing\HasherInterface;
use App\Auth\Providers\UserProvider;
use App\Cookie\CookieJar;
use App\Session\SessionInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Auth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Auth::class, function () use ($container) {

            return new Auth(
                $container->get(SessionInterface::class),
                $container->get(HasherInterface::class),
                new Recaller,
                new UserProvider,
                $container->get(CookieJar::class)
            );
        });
    }
}
