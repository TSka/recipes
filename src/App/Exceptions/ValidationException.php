<?php

namespace App\Exceptions;

class ValidationException extends \InvalidArgumentException
{
    private $errors;

    public function __construct($errors)
    {
        parent::__construct('Validation failed.', 422);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
