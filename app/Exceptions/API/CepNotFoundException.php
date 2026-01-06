<?php

namespace App\Exceptions\API;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class CepNotFoundException extends RuntimeException {
    public function __construct(string $message = 'O CEP informado não foi encontrado.') {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }
}
