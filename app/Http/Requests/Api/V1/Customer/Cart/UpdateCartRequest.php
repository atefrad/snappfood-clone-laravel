<?php

namespace App\Http\Requests\Api\V1\Customer\Cart;

use App\Models\Food;
use App\Rules\CheckRestaurantIsOpen;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
{
    protected Food $food;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        /** @var Food $food */
        $food = Food::query()->find(request('food_id'));

        $this->food = $food;

        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }
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
            'food_id' => ['required', 'integer', 'exists:foods,id', new CheckRestaurantIsOpen($this->food)],
            'count' => ['required', 'integer', 'min:0'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return array_merge(
            ['restaurant_id' => $this->food->restaurant_id],
            parent::validated($key, $default)
        );
    }
}
