<?php

namespace App\Http\Requests\Seller\FoodParty;

use App\Services\RealTimestamp;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $food
 */
class StoreFoodPartyRequest extends FormRequest
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
            'start_date' => ['required', 'integer'],
            'end_date' => ['required', 'integer', 'gt:start_date']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $startDate = RealTimestamp::getRealTimestamp(request('start_date'), '00:00:00');

        $endDate = RealTimestamp::getRealTimestamp(request('end_date'), '23:59:59');

        return array_merge(
            parent::validated($key, $default),
            [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'food_id' => $this->food->id
            ]
        );
    }
    public function messages(): array
    {
        return [
          'end_date.gt' => __('validation.messages.end_date_gt')
        ];
    }
}
