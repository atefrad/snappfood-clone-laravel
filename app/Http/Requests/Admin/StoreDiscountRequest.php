<?php

namespace App\Http\Requests\Admin;

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
        $realStartedAtTimeStamp = substr(request('started_at'), 0, 10);
        $startedAt = date('Y-m-d H:i:s', (int)$realStartedAtTimeStamp);

        $realExpiredAtTimeStamp = substr(request('expired_at'), 0, 10);
        $expiredAt = date('Y-m-d H:i:s', (int)$realExpiredAtTimeStamp);

        return array_merge(
            parent::validated($key, $default),
            [
                'started_at' => $startedAt,
                'expired_at' => $expiredAt
            ]
        );

    }
}
