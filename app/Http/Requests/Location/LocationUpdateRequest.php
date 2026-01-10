<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:location,id'],
            'address_id' => ['sometimes', 'integer'],
            'type' => ['sometimes', 'string'],
            'longitude' => ['sometimes', 'numeric', 'regex:/^-?\d+([.,]\d{1,7})?$/'],
        'latitude'  => ['sometimes', 'numeric', 'regex:/^-?\d+([.,]\d{1,7})?$/'],

        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O ID é um campo obrigatório.',
            'id.integer' => 'O paginador deve ser um valor inteiro.',
            'id.exists' => 'O ID informado não existe na tabela de localidades.',
            'address_id.integer' => 'O ID de endereço deve ser um valor inteiro.',
            'type.string' => 'O tipo deve ser um valor string.',
            'longitude.numeric' => 'A longitude deve ser um valor numérico.',
            'longitude.regex' => 'A longitude deve ter até no máximo 7 casas decimais.',
            'latitude.numeric' => 'A latitude deve ser um valor numérico.',
            'latitude.regex' => 'A latitude deve ter até no máximo 7 casas decimais.'
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
