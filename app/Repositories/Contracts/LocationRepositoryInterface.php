<?php

namespace App\Repositories\Contracts;

use App\Models\Location;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LocationRepositoryInterface
{
    public function index(array $data): LengthAwarePaginator;
    public function show(int $id): Location;

}
