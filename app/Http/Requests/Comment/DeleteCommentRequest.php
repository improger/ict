<?php
declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $comment = $this->route('comment');

        return $this->user()?->can('delete', $comment) ?? false;
    }
}
