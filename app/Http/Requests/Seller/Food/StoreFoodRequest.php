<?php

namespace App\Http\Requests\Seller\Food;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;

class StoreFoodRequest extends FormRequest
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
        ];
    }

    public function validated($key = null, $default = null)
    {
        /** @var Seller $seller */
        $seller = auth('seller')->user();
        $restaurantId =  $seller->restaurant->id;

        return array_merge(
            ['restaurant_id' => $restaurantId],
            parent::validated($key, $default)
        );
    }
}
