<?php

namespace App\Repositories\Contracts;

use App\Models\AddressData;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AddressDataRepositoryInterface
{
    public function index(array $data): LengthAwarePaginator;
    public function store(array $data): AddressData;
    public function update(array $data): AddressData;
    public function destroy(int $id): Bool;
}
