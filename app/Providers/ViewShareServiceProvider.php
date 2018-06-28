<?php

namespace App\Providers;

use App\Security\Csrf;
use App\Session\Flash;
use App\Views\View;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ViewShareServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot()
    {
        $container = $this->getContainer();

        $container->get(View::class)->share([
            'config' => $container->get('config'),
            'csrf' => $container->get(Csrf::class),
            'flash' => $container->get(Flash::class),
        ]);
    }

    public function register()
    {
        //
    }
}
