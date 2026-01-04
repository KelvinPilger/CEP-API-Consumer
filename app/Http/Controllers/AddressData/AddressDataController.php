<?php

namespace App\Http\Controllers\AddressData;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressData\AddressDataIndexRequest;
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
}
