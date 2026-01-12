<?php

namespace App\Repositories\Contracts;

use App\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LocationRepositoryInterface
{
    public function index(array $data): LengthAwarePaginator;
    public function show(int $id): Location;
    public function destroy(int $id): Bool;
    public function update(array $data): Location;
    public function store(array $data): Location;
    public function upsertByAddressId(array $data): Location;
    public function findByAddressId(int $address_id): ?Location;
}
