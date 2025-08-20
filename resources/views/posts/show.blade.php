<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
        <div class="text-sm text-gray-500 mb-4">
            by: {{ $post->user->name }} • {{ $post->created_at->format('Y-m-d H:i') }}
        </div>

        <div class="prose">{!! $post->body !!}</div>

        <div class="mt-4">
            @foreach($post->categories as $c)
                <a
                    class="px-2 py-0.5 border rounded mr-1"
                    href="{{ route('home',['category'=>$c->slug]) }}"
                >
                    {{ $c->name }}
                </a>
            @endforeach
        </div>

        @can('update', $post)
            <div class="mt-6 flex gap-2">
                <a
                    class="px-3 py-2 bg-yellow-500 text-white rounded"
                    href="{{ route('posts.edit',$post) }}"
                >
                    Edit
                </a>
                <form
                    method="POST"
                    action="{{ route('posts.destroy',$post) }}"
                    onsubmit="return confirm('Delete post?')"
                >
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 bg-red-600 text-white rounded">Delete</button>
                </form>
            </div>
        @endcan

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-2">Comments</h2>
        @auth
            <form
                method="POST"
                action="{{ route('comments.store',$post) }}"
                class="mb-4"
            >
                @csrf
                <textarea name="body" rows="3" class="border rounded px-3 py-2 w-full" placeholder="Write a comment..."></textarea>

                @error('body')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
                <button class="mt-2 px-3 py-2 bg-blue-600 text-white rounded">Add Comment</button>
            </form>
        @else
            <p class="text-sm">
                Please <a class="text-blue-600 underline" href="{{ route('login') }}">log in</a> to comment.
            </p>
        @endauth

        @if($post->comments->isNotEmpty())
            @foreach($post->comments as $comment)
                <div class="border rounded p-3 mb-2">
                    <div class="text-sm text-gray-600">
                        {{ $comment->user->name }} • {{ $comment->created_at->diffForHumans() }}
                    </div>
                    <div class="mt-1">{{ $comment->body }}</div>

                    @can('delete', $comment)
                        <form
                            method="POST"
                            action="{{ route('comments.destroy', $comment) }}"
                            class="mt-2"
                            onsubmit="return confirm('Delete comment?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 text-sm">Delete</button>
                        </form>
                    @endcan
                </div>
            @endforeach
        @else
            <p class="text-sm text-gray-600">No comments yet.</p>
        @endif
    </div>
</x-app-layout>
