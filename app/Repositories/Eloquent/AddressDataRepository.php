<?php

namespace App\Repositories\Eloquent;

use App\Models\AddressData;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

class AddressDataRepository extends BaseRepository implements AddressDataRepositoryInterface
{
    public function model()
    {
        return AddressData::class;
    }

    public function index(array $data): LengthAwarePaginator {
        $perPage = $data['perPage'] ?? 20;

        return AddressData::with('location')
            ->paginate($perPage);
    }

    public function store(array $data): AddressData {
        $address = AddressData::create($data);
        return $address;
    }

    public function update(array $data): AddressData {
        $id = (int) $data['id'];

        $address = AddressData::withTrashed()
            ->findOrFail($id);

        $address->update($data);

        return $address;
    }

    public function destroy(int $id): Bool {
        $address = AddressData::withTrashed()
            ->findOrFail($id);

        if($address->trashed()) {
            throw new HttpException(Response::HTTP_CONFLICT, 'O registro informado já se encontra como excluído/inativo.');
        }

        return (bool) $address->delete();
    }

    public function show(int $id): AddressData {
        return $address = AddressData::with('location')
            ->findOrFail($id);
    }

    public function restore(int $id): Bool {

        $address = AddressData::withTrashed()
            ->findOrFail($id);

        if(!$address->trashed()) {
            throw new HttpException(Response::HTTP_CONFLICT, 'O registro informado já se encontra ativo/restaurado.');
        }

        return (bool) $address->restore();
    }
}
