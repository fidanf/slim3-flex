<?php

$container = new League\Container\Container;

// Autowiring enabled
$container->delegate(new League\Container\ReflectionContainer);

// Core providers
$container->addServiceProvider(new App\Providers\ConfigServiceProvider);
$container->addServiceProvider(new App\Providers\SlimServiceProvider);

// Additionnal providers
foreach ($container->get('config')->get('providers') as $provider) {
    $container->addServiceProvider($provider);
}