<?php

namespace App\Services\AddressData;

use App\Models\AddressData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\EloquentModelNotFoundException;
use App\Exceptions\Cep\{
    InvalidCepException,
    CepNotFoundException,
    CepGatewayTimeoutException
};

class AddressDataService
{
    public function __construct(AddressDataRepositoryInterface $repository, LocationRepositoryInterface $locationRepository) {
        $this->repository = $repository;
        $this->locationRepository = $locationRepository;
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
            $response = Http::timeout(3)
                ->get("https://brasilapi.com.br/api/cep/v2/{$cep}")
                ->throw();

            $payload = $response->json();

            return DB::transaction(function () use ($payload) {
                $addressData = $this->repository->store($payload);

                if(data_get($payload, 'location.coordinates') !== [] && data_get($payload, 'location.coordinates') !== null) {

                    $locationPayload = [
                        'address_id' => $addressData->id,
                        'type' => data_get($payload, 'location.type'),
                        'latitude' => data_get($payload, 'location.coordinates.latitude'),
                        'longitude' => data_get($payload, 'location.coordinates.longitude')
                    ];

                    $this->locationRepository->store($locationPayload);

                    $addressData->loadMissing('location');
                }

                return $addressData;
            });

        } catch(RequestException $e) {

            $status = $e->response?->status();

            if($status === null) {
                throw new HttpException(503, 'Falha de conexão ao consultar o serviço de CEP.');
            }

            return match($status) {
                404 => throw new CepNotFoundException(),
                400 => throw new InvalidCepException(),
                504 => throw new CepGatewayTimeout(),
                default => throw new HttpException(502, 'O serviço de CEP não conseguiu responder à solicitação.')
            };
        }
    }

    public function update(array $data): AddressData {
        $cep = preg_replace('/\D/', '', $data['cep']);

        try {
            $response = Http::timeout(3)
                ->get("https://brasilapi.com.br/api/cep/v2/{$cep}")
                ->throw();

            $payload = array_merge($data, $response->json());

            return DB::transaction(function () use ($payload, $cep) {

                $addressId = (int) $payload['id'];
                $addressModel = $this->repository->show($addressId);

                $addressData = $this->repository->update($payload);

                if(data_get($payload, 'location.coordinates') !== [] && data_get($payload, 'location.coordinates') !== null) {

                    $locationPayload = [
                        'address_id' => $addressId,
                        'type' => data_get($payload, 'location.type'),
                        'latitude' => data_get($payload, 'location.coordinates.latitude'),
                        'longitude' => data_get($payload, 'location.coordinates.longitude')
                    ];

                    $this->locationRepository->upsertByAddressId($locationPayload);

                    $addressData->loadMissing('location');

                } else {
                    $location = $this->locationRepository->findByAddressId($addressId);

                    if($location !== null && $addressModel->cep !== $cep) {
                        $this->locationRepository->destroy($location->id);
                    }
                }

                return $addressData;
            });

        } catch(RequestException $e) {

            $status = $e->response?->status();

            if($status === null) {
                throw new HttpException(503, 'Falha de conexão ao consultar o serviço de CEP.');
            }

            match($status) {
                400 => throw new InvalidCepException(),
                404 => throw new CepNotFoundException(),
                504 => throw new CepGatewayTimeoutException(),
                default => throw new HttpException(502, 'O serviço de CEP não conseguiu responder à solicitação.')
            };
        }
    }

    public function destroy(array $data): Bool {
        try {
            $id = (int) $data['id'];
            return $this->repository->destroy($id);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function show(array $data): AddressData {
        try {
            $id = (int) $data['id'];
            return $this->repository->show($id);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function restore(array $data): Bool {
        try {
            $id = (int) $data['id'];
            return $this->repository->restore($id);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
