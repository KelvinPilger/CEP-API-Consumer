<?php

namespace App\Exceptions\API;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class InvalidCepException extends RuntimeException {
    public function __construct(string $message = 'O CEP informado é inválido ou está fora do padrão desejado.') {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
