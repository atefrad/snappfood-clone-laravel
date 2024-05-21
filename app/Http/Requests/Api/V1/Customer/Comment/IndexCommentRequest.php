<?php

namespace App\Http\Requests\Api\V1\Customer\Comment;

use Illuminate\Foundation\Http\FormRequest;

class IndexCommentRequest extends FormRequest
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
        $this->merge([
            'restaurant_id' => $this->query('restaurant_id') ?? '',
            'food_id' => $this->query('food_id') ?? ''
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
            'restaurant_id' => ['required_without:food_id', 'integer', 'exists:restaurants,id'],
            'food_id' => ['required_without:restaurant_id', 'integer', 'exists:foods,id'],
        ];
    }
}
