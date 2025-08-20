<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\Post\EditPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categorySlug = $request->query('category');

        $posts = Post::query()
            ->with('user', 'categories')
            ->when($categorySlug, fn($q) => $q->whereHas(
                'categories', fn($qq) => $qq->where('slug', $categorySlug)
            ))
            ->search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('posts.index', compact([
            'posts',
            'categories',
            'search',
            'categorySlug'
        ]));
    }

    public function create(CreatePostRequest $request)
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('posts.create', compact(['categories']));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::query()
            ->create([
                'title' => $request->title,
                'body' => $request->body,
                'user_id' => auth()->id(),
            ]);

        $post->categories()
            ->sync($request->input(['categories'], []));

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post created');
    }

    public function show(Post $post)
    {
        $post->load('user', 'categories', 'comments.user');

        return view('posts.show', compact(['post']));
    }

    public function edit(EditPostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('posts.edit', compact('post', ['categories']));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->only('title', 'body'));
        $post->categories()->sync($request->input('categories', []));

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Post updated');
    }

    public function destroy(DeletePostRequest $request, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted');
    }
}

