<?php

namespace App\Http\Controllers\AddressData;

use App\Http\Controllers\Controller;

use App\Http\Requests\AddressData\AddressDataIndexRequest;
use App\Http\Requests\AddressData\AddressDataStoreRequest;
use App\Http\Requests\AddressData\AddressDataUpdateRequest;
use App\Http\Requests\AddressData\AddressDataDestroyRequest;

use App\Http\Resources\AddressData\AddressDataResource;
use App\Http\Resources\AddressData\AddressDataCollection;
use App\Services\AddressData\AddressDataService;
use Illuminate\Http\Request;

class AddressDataController extends Controller
{
    public function __construct(AddressDataService $service) {
        $this->service = $service;
    }

    protected function service() {
        return $this->service;
    }

    protected function resource() {
        return AddressDataResource::class;
    }

    protected function collection() {
        return AdddressDataCollection::class;
    }

    public function index(AddressDataIndexRequest $request) {
        return parent::abstractIndex($request);
    }

    public function store(AddressDataStoreRequest $request) {
        return parent::abstractStore($request);
    }

    public function update(AddressDataUpdateRequest $request) {
        return parent::abstractUpdate($request);
    }

    public function destroy(AddressDataDestroyRequest $request) {
        return parent::abstractDestroy($request);
    }
}
