<?php

namespace App\Http\Requests\Seller\Food;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'food_category_id' => ['required', 'array', 'min:1'],
            'food_category_id.*' => ['required', 'integer', 'exists:food_categories,id'],
            'ingredient' => ['nullable', 'string', 'min:2', 'max:255'],
            'price' => ['required', 'integer', 'min:1000'],
            'image' => ['image', 'mimes:jpg,jpeg,png,gif'],
            'discount' => ['nullable' ,'integer', 'exists:discounts,id'],
        ];
    }
}
