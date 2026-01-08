<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Location\LocationIndexRequest;
use App\Http\Requests\Location\LocationShowRequest;
use App\Services\Location\LocationService;
use App\Http\Resources\Location\LocationResource;
use App\Http\Resources\Location\LocationCollection;

class LocationController extends Controller
{
    public function __construct(LocationService $service) {
        $this->service = $service;
    }

    protected function service() {
        return $this->service;
    }

    protected function resource() {
        return LocationResource::class;
    }

    protected function collection() {
        return LocationCollection::class;
    }

    public function index(LocationIndexRequest $request) {
        return parent::abstractIndex($request);
    }

    public function show(LocationShowRequest $request) {
        return parent::abstractShow($request);
    }
}
