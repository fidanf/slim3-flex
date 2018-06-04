<?php

namespace App\Providers;

use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;
use App\Views\View;
use App\Views\Extensions\DumpExtension;
use App\Views\Extensions\RouteExtension;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ViewServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        View::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(View::class, function () use ($config, $container) {
            
            $loader = new Twig_Loader_Filesystem(base_path('resources/views'));

            $twig = new Twig_Environment($loader, [
                'cache' => $config->get('twig.cache'),
                'debug' => $config->get('twig.debug')
            ]);

            $twig->addExtension(new Twig_Extension_Debug);
            $twig->addExtension(new DumpExtension);
            $twig->addExtension(new RouteExtension(
                $container->get('router'),
                $container->get('request')->getUri()
            ));

            foreach ($config->get('twig.globals') as $key => $value) {
                $twig->addGlobal($key, $value);
            }

            return new View($twig);

        });
    }
}
