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
        try {
            $perPage = $data['perPage'] ?? 20;

            return AddressData::paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Não foi possível realizar a consulta dos endereços.');
        }
    }

    public function store(array $data): AddressData {
        try {
            return AddressData::create($data);
        } catch (Exception $e) {
            throw new Exception('Não foi possível salvar o endereço.');
        }
    }

    public function update(array $data): AddressData {
        try {
            $id = (int) $data['id'];

            $address = AddressData::findOrFail($id);
            $address->update($data);

            return $address;
        }  catch (Exception $e) {
            throw new Exception('Não foi possível atualizar o endereço.');
        }
    }

    public function destroy(int $id): Bool {
        try {
            $address = AddressData::findOrFail($id);
            return (bool) $address->delete();
        }  catch (Exception $e) {
            throw new Exception('Não foi possível excluir o endereço.');
        }
    }

    public function show(int $id): AddressData {
        try {
            return $address = $address = AddressData::findOrFail($id);
        }  catch (Exception $e) {
            throw new Exception('Não foi possível visualizar o endereço.');
        }
    }

    public function restore(int $id): Bool {
        try {
            return AddressData::onlyTrashed()
                ->findOrFail($id)
                ->restore();
        } catch (Exception $e) {
            throw new Exception('Não foi possível realizar a restauração do registro.');
        }
    }
}
