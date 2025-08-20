<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Edit Post</h1>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @method('PUT')
            @include('posts._form', ['post' => $post])
        </form>
    </div>
</x-app-layout>
<?php
