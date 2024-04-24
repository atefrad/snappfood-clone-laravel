<?php

namespace App\Http\Requests\Seller\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRestaurantRequest extends FormRequest
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
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string', 'min:5'],
            'phone' => ['required', 'string'],
            'bank_account_number' => ['required', 'numeric']
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(
            parent::validated($key, $default),
            ['seller_id' => Auth::guard('seller')->id()],
            ['address' => [
                'state' => request('state'),
                'city' => request('city'),
                'address' => request('address')
            ]]
        );
    }
}
