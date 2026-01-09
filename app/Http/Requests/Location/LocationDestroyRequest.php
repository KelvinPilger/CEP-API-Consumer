<?php

namespace App\Http\Requests\Location;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class LocationDestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID é um campo obrigatório.',
            'id.integer' => 'O paginador deve ser um valor inteiro.'
        ];
    }

    public function validationData(): array
    {
        $data = array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);

        return $data;
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
