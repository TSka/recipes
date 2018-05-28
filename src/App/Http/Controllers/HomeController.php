<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;

class HomeController
{
    public function __invoke(ServerRequestInterface $request)
    {
        return new EmptyResponse();
    }
}