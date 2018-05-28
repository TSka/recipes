<?php

use App\Http\Middleware as App;
use Framework\Http\Middleware as Framework;

/** @var \Framework\Http\Application $app */

$app->pipe($container->get(App\ErrorHandler::class));

$app->pipe($container->get(\Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware::class));
$app->pipe($container->get(Framework\RouteMiddleware::class));

$app->pipe($container->get(Framework\DispatchMiddleware::class));

$app->pipe($container->get(App\NotFoundHandler::class));

