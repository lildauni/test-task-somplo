<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\ValidationRule;

class CreateSellerRequest extends ApiRequest
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
            'seller_name' => 'required|string|max:255'
        ];
    }
}
