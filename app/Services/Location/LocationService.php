<?php

namespace App\Services\Location;

use App\Repositories\Contracts\LocationRepositoryInterface;
use Throwable;
use App\Models\Location;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LocationService
{
    public function __construct(LocationRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index(array $data): LengthAwarePaginator {
        try {
            return $this->repository->index($data);
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function show(array $data): Location {
        try {
            $id = (int) $data['id'];
            return $this->repository->show($id);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
