<?php

foreach ($container->get('config')->get('middlewares') as $middleware) {
    $app->add($container->get($middleware));
}