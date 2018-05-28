<?php

namespace Framework\Http;

use Framework\Http\Router\RouteData;
use Framework\Http\Router\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Stdlib\ResponseInterface;
use Zend\Stratigility\MiddlewarePipeInterface;

class Application
{
    /** @var MiddlewarePipeInterface */
    private $pipeline;
    
    /** @var Router */
    private $router;

    public function __construct(MiddlewarePipeInterface $pipeline, Router $router)
    {
        $this->pipeline = $pipeline;
        $this->router = $router;
    }

    public function pipe(MiddlewareInterface $middleware): void
    {
        $this->pipeline->pipe($middleware);
    }

    public function run(ServerRequestInterface $request)
    {
        return $this->pipeline->handle($request);
    }


    /* Routing */

    private function route($name, $path, $handler, array $methods, array $options = []): void
    {
        $this->router->addRoute(new RouteData($name, $path, $handler, $methods, $options));
    }

    public function any($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, $options);
    }

    public function get($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['GET'], $options);
    }

    public function post($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['POST'], $options);
    }

    public function put($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PUT'], $options);
    }

    public function patch($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PATCH'], $options);
    }

    public function delete($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['DELETE'], $options);
    }
}