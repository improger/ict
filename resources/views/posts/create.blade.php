<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">New Post</h1>
        <form
            method="POST"
            action="{{ route('posts.store') }}"
        >
            @include('posts._form', ['post' => new \App\Models\Post()])
        </form>
    </div>
</x-app-layout>
