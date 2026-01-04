<?php

namespace App\Http\Requests\AddressData;

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

        ];
    }
}
