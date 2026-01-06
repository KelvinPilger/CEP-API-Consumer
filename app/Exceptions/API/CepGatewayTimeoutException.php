<?php

namespace App\Exceptions\API;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class CepGatewayTimeoutException extends RuntimeException {
    public function __construct(string $message = 'O serviço de CEP não conseguiu responder a requisição no tempo esperado.') {
        parent::__construct($message, Response::HTTP_GATEWAY_TIMEOUT);
    }
}
