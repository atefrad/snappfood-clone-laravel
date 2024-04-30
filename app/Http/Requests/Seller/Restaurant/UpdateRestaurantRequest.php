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
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif'],
            'is_open' => ['required', 'integer', 'in:0,1'],
            'delivery_price' => ['required', 'integer', 'max:100000'],
            'working_days' => ['required', 'array', 'min:1', 'max:7'],
            'working_days.*' => ['required', 'string', 'in:شنبه,یکشنبه,دوشنبه,سه شنبه,چهارشنبه,پنجشنبه,جمعه'],
            'opening_time' => ['required', 'regex:/^([01][0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/u'],
            'closing_time' => ['required', 'regex:/^([01][0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/u'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(
            parent::validated($key, $default),
            ['address' => [
                'state' => request('state'),
                'city' => request('city'),
                'address' => request('address')
            ]]
        );
    }
}
