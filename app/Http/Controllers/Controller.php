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
        try {
            $deleted = $this->service()->destroy($request->validated());

            return response()->json([
                'code' => Response::HTTP_OK,
                'deleted' => $deleted,
                'message' => 'Registro excluso com sucesso!'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
				'code' => Response::HTTP_NOT_FOUND,
				'message' => 'O registro informado não foi encontrado!'
			], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
           return response()->json([
				'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
				'message' => 'Erro interno, não foi possível excluir o registro.',
				'exception' => $e->getMessage()
			]);
        }
    }
}
