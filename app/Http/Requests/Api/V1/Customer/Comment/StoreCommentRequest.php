<?php

namespace App\Http\Requests\Api\V1\Customer\Comment;

use App\Rules\CheckCartBelongsTo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
        $customerId = Auth::guard('customer')->id();

        $this->merge([
            'customer_id' => $customerId
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
            'cart_id' => ['required', 'integer', 'exists:carts,id', new CheckCartBelongsTo, 'exists:orders,cart_id'],
            'score' => ['required', 'integer', 'min:0', 'max:5'],
            'message' => ['required', 'string', 'min:2'],
            'customer_id' => ['required']
        ];
    }
}
