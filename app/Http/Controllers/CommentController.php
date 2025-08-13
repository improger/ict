<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Comment\DeleteCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(StoreCommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Comment added');
    }

    public function destroy(DeleteCommentRequest $request, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('success', 'Comment deleted');
    }
}
