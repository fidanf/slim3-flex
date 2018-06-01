<?php

namespace App\Providers;

use Noodlehaus\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ConfigServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Config::class,
        'config'
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share('config', function () {
            return new Config([
                base_path('config/app.php'),
                base_path('config/database.php')
            ]);
        });

        $container->share(Config::class, function () {
            return new Config([
                base_path('config/app.php'),
                base_path('config/database.php')
            ]);
        });

    }
}
