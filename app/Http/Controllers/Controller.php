<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    abstract protected function service();
    abstract protected function resource();

    protected function abstractIndex(FormRequest $request) {
        $data = $this->service()->index($request->validated());

        $resource = $this->resource();

        return $resource::collection($data);
    }

    protected function abstractStore(FormRequest $request) {
        $data = $this->service()->store($request->validated());

        $resource = $this->resource($data);
    }
}
