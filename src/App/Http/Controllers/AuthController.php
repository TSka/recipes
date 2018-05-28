<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\InputFilter\Factory;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress;

class AuthController extends AbstractController
{
    public function register(ServerRequestInterface $request)
    {
        $this->validate((new Factory())
            ->createInputFilter([
                'email' => [
                    'name' => 'email',
                    'required' => true,
                    'validators' => [
                        new EmailAddress(),
                    ],
                ],
                'password' => [
                    'name' => 'password',
                    'required' => true,
                ],
            ])
            ->setData($request->getParsedBody())
        );

        return new JsonResponse($request->getParsedBody());
    }
}