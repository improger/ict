@csrf
<div class="space-y-4">
    <div>
        <label class="block mb-1">Title</label>
        <input
            name="title"
            value="{{ old('title', $post->title ?? '') }}"
            class="border rounded px-3 py-2 w-full"
        >

        @error('title')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1">Body</label>
        <textarea name="body" rows="8" class="border rounded px-3 py-2 w-full">{{ old('body', $post->body ?? '') }}</textarea>

        @error('body')
        <div class="text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block mb-1">Categories</label>
        <select
            name="categories[]"
            multiple class="border rounded px-3 py-2 w-full"
        >
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(collect(old('categories', isset($post) ? $post->categories->pluck('id')->all() : []))->contains($category->id))
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('categories.*')
        <div class="text-red-600 text-sm">{{ $message }}</div>@enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
</div>
<?php
