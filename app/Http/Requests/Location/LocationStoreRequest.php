<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address_id' => ['required', 'integer'],
            'type' => ['required', 'string'],
            'longitude' => ['required', 'numeric', 'regex:/^-?\d+([.,]\d{1,7})?$/'],
            'latitude'  => ['required', 'numeric', 'regex:/^-?\d+([.,]\d{1,7})?$/'],

        ];
    }

    public function messages(): array
    {
        return [
            'address_id.required' => 'O ID do endereço é um campo obrigatório.',
            'address_id.integer' => 'O ID do endereço deve ser um valor inteiro.',
            'type.required' => 'O tipo é um valor obrigatório.',
            'type.string' => 'O tipo deve ser um valor string.',
            'longitude.required' => 'A longitude é um valor obrigatório.',
            'longitude.numeric' => 'A longitude deve ser um valor numérico.',
            'longitude.regex' => 'A longitude deve ter até no máximo 7 casas decimais.',
            'latitude.required' => 'A latitude é um valor obrigatório.',
            'latitude.numeric' => 'A latitude deve ser um valor numérico.',
            'latitude.regex' => 'A latitude deve ter até no máximo 7 casas decimais.'
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
