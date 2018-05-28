<?php

namespace App\Http\Middleware;

use App\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class ErrorHandler implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'errors' => $e->getErrors(),
                ],
            ], $e->getCode());
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ],
            ], $e->getCode() ?: 500);
        }
    }
}