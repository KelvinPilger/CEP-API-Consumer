<?php

namespace App\Repositories\Eloquent;

use App\Models\AddressData;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function update(array $data): AddressData {
        $id = (int) $data['id'];

        $address = AddressData::findOrFail($id);
        $address->update($data);

        return $address;
    }

    public function destroy(int $id): Bool {
        $address = AddressData::findOrFail($id);
        return (bool) $address->delete();
    }

    public function show(int $id): AddressData {
        return $address = $address = AddressData::findOrFail($id);

    }

    public function restore(int $id): Bool {
        return AddressData::onlyTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
