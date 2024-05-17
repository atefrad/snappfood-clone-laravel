<?php

namespace App\Http\Requests\Api\V1\Customer\Cart;

use App\Models\Food;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'food_id' => ['required', 'integer', 'exists:foods,id'],
            'count' => ['required', 'integer', 'min:0'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        /** @var Food $food */
        $food = Food::query()->find(request('food_id'));

        return array_merge(
            ['restaurant_id' => $food->restaurant_id],
            parent::validated($key, $default)
        );
    }
}
