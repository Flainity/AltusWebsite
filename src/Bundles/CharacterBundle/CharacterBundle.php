<?php

namespace App\Bundles\CharacterBundle;

use App\Bundles\FiestaBundleInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class CharacterBundle extends Bundle implements FiestaBundleInterface
{
    function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('@CharacterBundle/Resources/config/services.yaml');
        $container->import('@CharacterBundle/Resources/config/{services}_' . $container->env() . '.yaml');
    }

    function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('@CharacterBundle/Resources/config/routes.yaml');
    }
}