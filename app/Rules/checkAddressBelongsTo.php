<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class checkAddressBelongsTo implements ValidationRule, DataAwareRule
{
    protected array $data;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $customerAddress = $this->data['customer']->addresses()->find($value);

        if(!$customerAddress)
        {
            $fail('validation.check_address_belongs_to')->translate();
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
