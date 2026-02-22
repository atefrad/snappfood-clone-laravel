<?php

namespace App\Http\Requests\Api\V1\Customer\Cart;

use App\Models\Cart;
use App\Models\Food;
use App\Rules\CheckRestaurantIsOpen;
use App\Rules\ValidRestaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreCartRequest extends FormRequest
{
    protected ?Food $food = null;
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
            'food_id' => ['required', 'integer', 'exists:foods,id', new CheckRestaurantIsOpen()],
            'count' => ['required', 'integer', 'min:1'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $this->food = Food::query()->find($data['food_id']);

        return array_merge($data,[
                'restaurant_id' => $this->food->restaurant_id,
                'customer_id' => Auth::guard('customer')->id()
            ]);
    }
}
