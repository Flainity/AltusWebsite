<?php

namespace App\Bundles\MainBundle;

use App\Bundles\FiestaBundleInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class MainBundle extends Bundle implements FiestaBundleInterface
{
    function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('@MainBundle/Resources/config/services.yaml');
        $container->import('@MainBundle/Resources/config/{services}_' . $container->env() . '.yaml');
    }

    function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('@MainBundle/Resources/config/routes.yaml');
    }
}