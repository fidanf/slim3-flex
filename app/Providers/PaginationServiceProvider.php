<?php

namespace App\Providers;

use App\Views\View;
use App\Views\ViewPaginationFactory;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class PaginationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
	public function boot()
    {
    	$container = $this->getContainer();

    	LengthAwarePaginator::viewFactoryResolver(function () use ($container) {
    		return new ViewPaginationFactory($container->get(View::class));
    	});

        LengthAwarePaginator::currentPathResolver(function () use ($container) {
            return $container->get('request')->getUri()->getPath();
        });

        LengthAwarePaginator::currentPageResolver(function () use ($container) {
            return $container->get('request')->getQueryParams()['page'] ?? 1;
        });

        LengthAwarePaginator::defaultView('pagination/_bootstrap.twig');
    }

    public function register()
    {
        //
    }
}
