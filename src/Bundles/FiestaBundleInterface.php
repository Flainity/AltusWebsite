<?php

namespace App\Bundles;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

interface FiestaBundleInterface
{
    function configureContainer(ContainerConfigurator $container): void;
    function configureRoutes(RoutingConfigurator $routes): void;
}