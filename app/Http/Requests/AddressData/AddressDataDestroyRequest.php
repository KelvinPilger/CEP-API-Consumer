<?php

namespace App\Http\Requests\AddressData;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class AddressDataDestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:address_data,id'],
        ];
    }

    public function messages(): array {
        return [
            'id.required' => 'O ID do endereço deve ser informado.',
            'id.integer' => 'O ID deve ser um valor do tipo inteiro.',
            'id.exists' => 'O ID informado não existe na tabela de endereços.',
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
