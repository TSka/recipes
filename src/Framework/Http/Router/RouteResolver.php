<?php

namespace Framework\Http\Router;

use App\Http\Controllers\AbstractController;
use Framework\Http\Router\Exception\ControllerNotFoundException;
use Framework\Http\Router\Exception\UnknownRouteHandlerException;
use Psr\Container\ContainerInterface;

class RouteResolver
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resolve($handler): callable
    {
        if (is_array($handler)) {
            $class = $handler[0];
            $method = $handler[1];
            if (method_exists($class, $method)) {
                return function () use ($class, $method) {
                    return call_user_func_array([new $class, $method], func_get_args());
                };
            }

            throw new ControllerNotFoundException(implode($handler, '::'));
        }

        if (is_callable($handler)) {
            return $handler;
        }

        if (is_string($handler)) {
            if (class_exists($handler)) {
                return function() use ($handler) {
                    $class = new $handler;
                    return $class(...func_get_args());
                };
            }

            if (strpos($handler, '@') !== false) {
                $call = explode('@', $handler);
                $class = $call[0];
                $method = $call[1];
                if (method_exists($class, $method)) {
                    return function () use ($class, $method) {
                        return call_user_func_array([new $class, $method], func_get_args());
                    };
                }

                throw new ControllerNotFoundException(implode($call, '::'));
            }
        }

        throw new UnknownRouteHandlerException($handler);
    }

}