<?php

namespace App\Providers;

use App\Database\DatabaseInterface;
use App\Database\Eloquent;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [
        DatabaseInterface::class
    ];

    public function boot()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(DatabaseInterface::class, function () use ($config) {
            
            $capsule = new Eloquent;
            $capsule->addConnection($config->get('db'));
            
            return $capsule;
            
        });

        $eloquent = $container->get(DatabaseInterface::class);
        $eloquent->bootEloquent();
        $eloquent->setAsGlobal();
    }

    public function register()
    {
        //
    }
}
