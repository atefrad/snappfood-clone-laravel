<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Food;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Symfony\Component\HttpFoundation\Response;

class ValidRestaurant implements DataAwareRule,ValidationRule
{
    protected array $data;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var Cart $cart */
        $cart = Cart::query()->find($value);

        if($cart->restaurant_id !== $this->data['restaurant_id'])
        {
            $fail('validation.valid_restaurant')->translate();
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
