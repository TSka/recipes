<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use Zend\InputFilter\InputFilterInterface;

class AbstractController
{
    public function validate(InputFilterInterface $inputFilter)
    {
        if (!$inputFilter->isValid()) {
            throw new ValidationException($inputFilter->getMessages());
        }
    }
}