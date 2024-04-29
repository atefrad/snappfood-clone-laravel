<?php

namespace App\Http\Requests\Admin\Banner;

use App\Services\RealTimestamp;
use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,gif'],
            'url' => ['required', 'string', 'url'],
            'expired_at' => ['required', 'integer']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $expiredAt = RealTimestamp::getRealTimestamp(request('expired_at'), '23:59:59');

        return array_merge(
            parent::validated($key, $default),
            [
                'expired_at' => $expiredAt
            ]
        );

    }
}
