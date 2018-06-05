<?php

namespace App\Providers;

use App\Database\DatabaseInterface;
use App\Database\Eloquent;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        DatabaseInterface::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(DatabaseInterface::class, function () use ($config) {
            
            $capsule = new Eloquent;
            $capsule->addConnection($config->get('db'));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            
            return $capsule;
        });

    }
}
