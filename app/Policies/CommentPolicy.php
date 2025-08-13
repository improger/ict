<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Comment $comment): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Comment $comment): bool
    {
        //
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function restore(User $user, Comment $comment): bool
    {
        //
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        //
    }
}
