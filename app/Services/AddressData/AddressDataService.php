<?php

namespace App\Services\AddressData;

use App\Models\AddressData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AddressDataService
{
    public function __construct(AddressDataRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index(array $data): LengthAwarePaginator {
        try {
            return $this->repository->index($data);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function store(array $data): AddressData {
        $cep = preg_replace('/\D/', '', $data['cep']);
        try {
            $response = Http::get("https://brasilapi.com.br/api/cep/v2/{$cep}")->throw();

            $data = $response->json();

            return $this->repository->store($data);

        } catch(RequestException $e) {

            $status = $e->response?->status();

            if ($status === null) {
                throw new HttpException(503, 'Falha de conexão ao consultar o serviço de CEP.');
            }

            if($status === 404) {
                throw new \DomainException('O CEP informado não foi encontrado.');
            }

            if($status === 400) {
                throw new \InvalidArgumentException('O CEP informado é inválido ou está fora do padrão desejado');
            }

            throw new HttpException(502, 'O servidor não conseguiu responder a solicitação.');
        }
    }

    public function update(array $data): AddressData {
        $cep = preg_replace('/\D/', '', $data['cep']);

        try {
            $response = Http::get("https://brasilapi.com.br/api/cep/v2/{$cep}")->throw();

            $data = array_merge($data, $response->json());

            return $this->repository->update($data);

        } catch(RequestException $e) {
            $status = $e->response?->status();

            if ($status === null) {
                throw new HttpException(503, 'Falha de conexão ao consultar o serviço de CEP.');
            }

            if($status === 404) {
                throw new \DomainException('O CEP informado não foi encontrado.');
            }

            if($status === 400) {
                throw new \InvalidArgumentException('O CEP informado é inválido ou está fora do padrão desejado');
            }

            throw new HttpException(502, 'O servidor não conseguiu responder a solicitação.');
        }
    }

    public function destroy(array $data): Bool {
        try {
            $id = (int) $data['id'];
            return $this->repository->destroy($id);
        } catch (\ModelNotFoundException $e) {
            throw new \ModelNotFoundException('O ID informado não existe no banco de dados.');
        }
    }
}
