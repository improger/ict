<?php
declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'body' => [
                'required',
                'string',
                'max:2000',
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['body' => strip_tags((string)$this->body)]);
    }
}
