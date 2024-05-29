<?php

namespace App\Http\Requests\Seller\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
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
            'restaurant_category_id' => ['required', 'integer', 'exists:restaurant_categories,id'],
            'food_category_id' => ['required', 'array', 'min:1'],
            'food_category_id.*' => ['required', 'integer', 'exists:food_categories,id'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'address' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif'],
            'is_open' => ['required', 'integer', 'in:0,1'],
            'delivery_price' => ['required', 'integer'],
            'working_days' => ['required', 'array', 'min:1', 'max:7'],
            'working_days.*' => ['required', 'integer', 'min:0', 'max:6'],
            'opening_time' => ['required', 'regex:/^([01][0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/u'],
            'closing_time' => ['required', 'regex:/^([01][0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/u'],
        ];
    }
}
