@props(['post'])

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6 flex justify-between">
        <a href="{{ route('posts.show', $post) }}">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $post->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-600">
                    {{ Str::limit($post->body, 50) }}
                </p>
            </div>
        </a>

        <a href="{{ route('posts.edit', $post) }}">
            <x-button class="text-blue-500 hover:text-blue-700">
                Edit
            </x-button>
        </a>
    </div>
</div>