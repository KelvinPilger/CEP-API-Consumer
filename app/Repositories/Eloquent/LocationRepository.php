<?php

namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Contracts\LocationRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

class LocationRepository extends BaseRepository implements LocationRepositoryInterface
{
    public function model()
    {
        return Location::class;
    }

    public function index(array $data): LengthAwarePaginator {
        $perPage = (int) $data['perPage'] ?? 20;

        return Location::paginate($perPage);
    }

    public function show(int $id): Location {
        return Location::findOrFail($id);
    }

    public function destroy(int $id): Bool {
        $location = Location::findOrFail($id);

        return (bool) $location->delete();
    }

    public function update(array $data): Location {
        $location = Location::findOrFail($data['id']);
        $location->update($data);

        return $location;
    }

    public function upsertByAddressId(array $data): Location {
        return Location::query()
            ->updateOrCreate(
                ['address_id' => $data['address_id']], $data);
    }

    public function findByAddressId(int $address_id): ?Location {
        return Location::query()
            ->where('address_id', $address_id)
            ->first();
    }

    public function store(array $data): Location {
        return Location::create($data);
    }
}
