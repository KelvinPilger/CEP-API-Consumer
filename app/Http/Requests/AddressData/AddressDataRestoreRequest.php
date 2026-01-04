<?php

namespace App\Http\Requests\AddressData;

use Illuminate\Foundation\Http\FormRequest;

class AddressDataRestoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
