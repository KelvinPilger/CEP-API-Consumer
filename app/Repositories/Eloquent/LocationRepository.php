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
}
