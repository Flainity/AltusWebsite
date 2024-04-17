<?php

namespace App\Bundles\ShopBundle;

use App\Bundles\FiestaBundleInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class ShopBundle extends Bundle implements FiestaBundleInterface
{
    function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('@ShopBundle/Resources/config/services.yaml');
        $container->import('@ShopBundle/Resources/config/{services}_' . $container->env() . '.yaml');
    }

    function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('@ShopBundle/Resources/config/routes.yaml');
    }
}