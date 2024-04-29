<?php

namespace App\Http\Requests\Admin\Discount;

use App\Services\RealTimestamp;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
            'percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'started_at' => ['required', 'integer'],
            'expired_at' => ['required', 'integer', 'gt:started_at']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $startedAt = RealTimestamp::getRealTimestamp(request('started_at'), '00:00:00');

        $expiredAt = RealTimestamp::getRealTimestamp(request('expired_at'), '23:59:59');

        return array_merge(
            parent::validated($key, $default),
            [
                'started_at' => $startedAt,
                'expired_at' => $expiredAt
            ]
        );

    }
}
