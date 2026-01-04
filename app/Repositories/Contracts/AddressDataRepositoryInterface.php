<?php

namespace App\Repositories\Contracts;

use App\Models\AddressData;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AddressDataRepositoryInterface
{
    public function index(array $data): LengthAwarePaginator;
}
