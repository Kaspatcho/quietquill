<div class="dark:bg-gray-800 dark:text-gray-200">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg flex flex-col gap-y-2">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" class="mb-4" />
                @endforeach
            </div>
        </div>
    </div>
</div>