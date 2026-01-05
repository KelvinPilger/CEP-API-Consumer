<?php

namespace App\Http\Requests\AddressData;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class AddressDataStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function validationData(): array
    {
        $data = array_merge($this->all(), [
            'cep' => $this->route('cep'),
        ]);

        return $data;
    }

    public function rules(): array
    {
        return [
            'cep' => ['required', 'string', 'regex:/^\d{5}-?\d{3}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'cep.required' => 'O CEP deve ser informado.',
            'cep.string' => 'O CEP deve ser um valor do tipo string.',
            'cep.regex' => 'O CEP informado não está correto.'
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
