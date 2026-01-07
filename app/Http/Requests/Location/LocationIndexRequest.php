<?php

namespace App\Http\Requests\Location;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class LocationIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perPage' => ['integer', 'sometimes'],
        ];
    }

    public function messages(): array
    {
        return [
            'perPage.integer' => 'O paginador deve ser um valor inteiro.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'code' => 422,
                'message' => 'Houve um erro durante a validação da requisição.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
