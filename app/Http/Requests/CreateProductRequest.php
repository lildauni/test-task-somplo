<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_name' => 'required|numeric|max:10',
            'display_size' => 'required|numeric',
            'quantity' => 'required|numeric',
            'cost' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_name.required' => 'A phone name is required',
            'seller_id.required' => 'A seller is required',
            'display_size.required' => 'A display name is required',
            'quantity.required' => 'A quantity is required',
            'cost.required' => 'A cost is required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
