<?php

namespace App\Http\Requests\Api\V1\Customer\Cart;

use App\Models\Cart;
use App\Models\Food;
use App\Rules\ValidRestaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        /** @var Food $food */
        $food = Food::query()->find(request('food_id'));

        $this->merge([
            'customer_id' => Auth::guard('customer')->id(),
            'restaurant_id' => $food->restaurant_id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'food_id' => ['required', 'integer', 'exists:foods,id'],
            'count' => ['required', 'integer', 'min:1'],
            'cart_id' => ['nullable', 'integer', 'exists:carts,id', new ValidRestaurant],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'restaurant_id' => ['required', 'integer', 'exists:restaurants,id']
        ];
    }
}