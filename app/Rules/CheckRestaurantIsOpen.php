<?php

namespace App\Rules;

use App\Models\Food;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckRestaurantIsOpen implements ValidationRule
{
    protected ?Food $food;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->food = Food::query()->find($value);

        if(!$this->food || !$this->food->restaurant->realIsOpen)
        {
            $fail('validation.check_restaurant_is_open')->translate();
        }
    }
}
