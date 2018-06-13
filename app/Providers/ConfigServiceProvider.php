<?php

namespace App\Providers;

use Noodlehaus\Config;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [
        Config::class,
        'config'
    ];

    public function boot()
    {
        VarDumper::setHandler(function ($var) {
            $cloner = new VarCloner;
            $htmlDumper = new HtmlDumper;
            
            $htmlDumper->setStyles([
                'default' => 'background-color:#f6f6f6; color:#222; line-height:1.3em; 
                    font-weight:normal; font:16px Monaco, Consolas, monospace; 
                    word-wrap: break-word; white-space: pre-wrap; position:relative; 
                    z-index:100000',
                'public' => 'color:#ec9114',
                'protected' => 'color:#ec9114',
                'private' => 'color:#ec9114',
            ]);

            $dumper = PHP_SAPI === 'cli' ? new CliDumper : $htmlDumper;
            $dumper->dump($cloner->cloneVar($var));
        });
    }

    public function register()
    {
        $container = $this->getContainer();

        $container->share('config', function () {
            return new Config([
                base_path('config/app.php'),
                base_path('config/database.php'),
                base_path('config/views.php')
            ]);
        });

        $container->share(Config::class, function () {
            return new Config([
                base_path('config/app.php'),
                base_path('config/database.php'),
                base_path('config/views.php')
            ]);
        });

    }
}
