<?php

namespace App\Http\Requests\Api\V1\Customer\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAddressRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'min:5', 'max:255'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $customerId = Auth::guard('customer')->id();

        return array_merge(
            ['customer_id' => $customerId],
            parent::validated($key, $default)
        );
    }
}
