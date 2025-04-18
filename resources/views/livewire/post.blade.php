<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 pb-5 overflow-hidden shadow-xl sm:rounded-lg">
                <x-post :body="$post->body" :tags="$post->tags" />
            </div>
        </div>
    </div>
</div>
