<?php

namespace App\Http\Requests\Admin\RestaurantCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle Validation for storing a new restaurant category.
     *
     * Ensures required fields are present and validates optional image upload.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255', 'unique:restaurant_categories'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif'],
            'description' => ['nullable', 'string', 'min:5', 'max:500']
        ];
    }
}
