<?php

namespace App\Http\Requests\Api\V1\Customer\Address;

use App\Models\Customer;
use App\Rules\checkAddressBelongsTo;
use App\Rules\checkAddressIsCurrent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SetCurrentAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        $oldCurrentAddressId = $customer->currentAddress ? $customer->currentAddress->id : null;

        $this->merge([
            'address_id' => $this->route('address')->id,
            'customer' => $customer,
            'old_current_address_id' => $oldCurrentAddressId
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
            'address_id' => ['required', 'integer', new checkAddressBelongsTo, new checkAddressIsCurrent],
            'customer' => ['required'],
            'old_current_address_id' => ['nullable']
        ];
    }
}
