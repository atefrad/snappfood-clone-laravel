<?php

namespace App\Http\Requests\Seller\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentDeleteRequest extends FormRequest
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
            'comment_id' => $this->route('comment')->id
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
            'comment_id' => ['required', 'unique:comment_delete_requests'],
            'body' => ['required', 'string', 'min:2']
        ];
    }

    public function messages(): array
    {
        return [
            'comment_id' => 'شما قبلا برای این نظر درخواست حذف ثبت کرده اید.',
        ];
    }
}
