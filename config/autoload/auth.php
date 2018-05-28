<?php

use App\Http\Middleware\AuthMiddleware;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            AuthMiddleware::class => function (ContainerInterface $container) {
                return new AuthMiddleware($container->get('config')['auth']['users']);
            },
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];
