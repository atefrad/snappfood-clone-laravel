<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class checkAddressIsCurrent implements ValidationRule, DataAwareRule
{
    protected array $data;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->data['old_current_address_id'] === $this->data['address_id'])
        {
            $fail('validation.check_address_is_current')->translate();
        }
    }

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
