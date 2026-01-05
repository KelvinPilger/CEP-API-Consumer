<?php

namespace App\Repositories\Eloquent;

use App\Models\AddressData;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class AddressDataRepository extends BaseRepository implements AddressDataRepositoryInterface
{
    public function model()
    {
        return AddressData::class;
    }

    public function index(array $data): LengthAwarePaginator {
        $perPage = $data['perPage'] ?? 20;

        return AddressData::paginate($perPage);
    }

    public function store(array $data): AddressData {
        return AddressData::create($data);
    }
}
