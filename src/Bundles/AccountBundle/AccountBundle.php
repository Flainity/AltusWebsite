<?php

namespace App\Bundles\AccountBundle;

use App\Bundles\FiestaBundleInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class AccountBundle extends Bundle implements FiestaBundleInterface
{
    function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('@AccountBundle/Resources/config/services.yaml');
        $container->import('@AccountBundle/Resources/config/{services}_' . $container->env() . '.yaml');
    }

    function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('@AccountBundle/Resources/config/routes.yaml');
    }
}