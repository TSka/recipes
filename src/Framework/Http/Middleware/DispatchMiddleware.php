<?php

namespace Framework\Http\Middleware;

use Framework\Http\Router\Result;
use Framework\Http\Router\RouteResolver;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DispatchMiddleware implements MiddlewareInterface
{
    private $resolver;

    public function __construct(RouteResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Result $result */
        if ($result = $request->getAttribute(Result::class)) {
            $action = $this->resolver->resolve($result->getHandler());
            return $action($request);
        }

        return $handler->handle($request);
    }
}