<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\ValidationRule;

class CreateProductRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_name' => 'required|numeric|max_digits:10',
            'display_size' => 'required|numeric',
            'quantity' => 'required|numeric',
            'cost' => 'required|numeric',
        ];
    }
}
