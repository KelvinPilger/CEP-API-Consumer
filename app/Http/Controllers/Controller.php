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

        $resource = $this->resource();

        return new $resource($data);
    }

    protected function abstractUpdate(FormRequest $request) {
        $data = $this->service()->update($request->validated());

        $resource = $this->resource();

        return new $resource($data);
    }

    protected function abstractDestroy(FormRequest $request) {
        $deleted = $this->service()->destroy($request->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'deleted' => $deleted,
            'message' => 'Registro excluso com sucesso!'
        ]);
    }

    protected function abstractShow(FormRequest $request) {
        $data = $this->service()->show($request->validated());

        $resource = $this->resource();

        return new $resource($data);
    }

    protected function abstractRestore(FormRequest $request) {
        $restored = $this->service()->restore($request->validated());

        return response()->json([
            'code' => Response::HTTP_OK,
            'restored' => $restored,
            'message' => 'Registro restaurado com sucesso!'
        ]);
    }
}
