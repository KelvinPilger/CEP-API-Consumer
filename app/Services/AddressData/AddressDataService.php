<?php

namespace App\Services\AddressData;

use App\Models\AddressData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\AddressDataRepositoryInterface;


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
}
