@props(['post'])

<div class="bg-gray-100 dark:bg-gray-900 shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6 flex justify-between">
        <a href="{{ route('posts.show', $post) }}">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    {{ $post->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-600 dark:text-gray-300">
                    {{ Str::limit($post->body, 50) }}
                </p>
            </div>
        </a>

        <a href="{{ route('posts.edit', $post) }}">
            <x-button class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-400">
                Edit
            </x-button>
        </a>
    </div>
</div>