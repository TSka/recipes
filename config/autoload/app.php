<?php

use Framework\Http\Application;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Http\Router\RouteResolver;
use Psr\Container\ContainerInterface;
use Zend\Stratigility\MiddlewarePipe;

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => array(
            Application::class => function (ContainerInterface $container) {
                return new Application(
                    $container->get(MiddlewarePipe::class),
                    $container->get(Router::class)
                );
            },
            Router::class => function () {
                return new AuraRouterAdapter(new Aura\Router\RouterContainer());
            },
            RouteResolver::class => function (ContainerInterface $container) {
                return new RouteResolver($container);
            }
        ),
    ],

    'debug' => false,
];
