<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <form
            method="GET"
            action="{{ route('home') }}"
            class="flex gap-2 mb-4"
        >
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search..."
                class="border rounded px-3 py-2 w-full"
            >
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
        </form>

        <div class="mb-4 flex gap-2 flex-wrap">
            @foreach($categories as $category)
                <a
                    href="{{ route('home', ['category'=>$category->slug] + request()->only('search')) }}"
                    class="px-2 py-1 border rounded {{ request('category')===$category->slug ? 'bg-gray-200' : '' }}"
                >
                    {{ $category->name }}
                </a>
            @endforeach

            @if(request('category'))
                <a href="{{ route('home', request()->only('search')) }}"
                   class="px-2 py-1 text-sm text-red-600"
                >
                    Clear filter
                </a>
            @endif
        </div>

        @auth
            <a
                href="{{ route('posts.create') }}"
                class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded"
            >
                New Post
            </a>
        @endauth

        @if($posts->isEmpty())
            <p>No posts.</p>
        @else
            @foreach($posts as $post)
                <article class="border rounded p-4 mb-3">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h2>

                    <div class="text-sm text-gray-500">
                        by: {{ $post->user->name }} • {{ $post->created_at->format('Y-m-d H:i') }}
                    </div>

                    <div class="mt-2 text-sm">
                        @foreach($post->categories as $c)
                            <a class="px-2 py-0.5 border rounded mr-1"
                               href="{{ route('home', ['category' => $c->slug]) }}">{{ $c->name }}
                            </a>
                        @endforeach
                    </div>
                </article>
            @endforeach
        @endif

        {{ $posts->links("pagination::bootstrap-4") }}
    </div>
</x-app-layout>
