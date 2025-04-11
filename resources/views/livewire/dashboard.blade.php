<div class="dark:bg-gray-800 dark:text-gray-200">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg flex flex-col gap-y-2">
                <div class="flex items-center gap-x-4 mb-4">
                    <x-input wire:model.live.debounce.500ms="search" type="search"
                        class="block w-full pl-10 text-sm text-gray-900" placeholder="Search posts..." />

                    <x-dropdown align="right" width="48" class="dark:bg-gray-700">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150 dark:text-gray-300 dark:bg-gray-700 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:bg-gray-600">
                                    {{ $selectedTag ?? __('Filter by Tag') }}
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            @foreach ($allTags as $tag)
                                <x-dropdown-link class="dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    wire:click="$set('selectedTag', '{{ $tag->name }}')">
                                    {{ $tag->name }}
                                </x-dropdown-link>
                            @endforeach

                            <div class="border-t border-gray-500"></div>

                            <x-dropdown-link class="dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                wire:click="$set('selectedTag', null)">
                                clear
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                @foreach ($posts as $post)
                    <x-post-card :post="$post" class="mb-4" />
                @endforeach

                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>