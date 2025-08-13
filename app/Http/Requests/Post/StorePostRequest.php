<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'body' => [
                'required',
                'string'
            ],
            'categories' => ['array'],
            'categories.*' => [
                'integer',
                'exists:categories,id',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => strip_tags((string)$this->title),
            'body' => strip_tags((string)$this->body, '<p><br><strong><em><ul><ol><li><a>'),
        ]);
    }
}
