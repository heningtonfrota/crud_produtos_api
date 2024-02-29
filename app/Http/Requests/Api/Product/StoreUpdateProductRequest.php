<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
            'name' => [
                'required',
                'max:50'
            ],
            'description' => [
                'required',
                'max:200'
            ], 
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'expiration_date' => [
                'required',
                'date', 
                'after:now'
            ],
            'category_id' => [
                'required'
            ],
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048'
            ]
        ];
    }
}
