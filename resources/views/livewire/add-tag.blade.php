<div class="dark:bg-gray-800 dark:text-white">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            {{ __('Add Tag') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900">
                <div class="container px-4 md:px-6 py-3">
                    <form wire:submit.prevent="save">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" type="text" class="mt-1 block w-full" wire:model.live="name" required
                            autofocus />
                        <x-input-error for="name" class="mt-2" />

                        <x-label class="my-3" for="color" value="{{ __('Color') }}" />
                        <div class="flex items-center">
                            <x-input id="color" type="color" class="block h-10 w-10 p-0 border-none rounded-full shadow"
                                wire:model.live="color" required />
                            <label for="color"
                                class="ml-3 text-sm text-gray-600 dark:text-gray-400">{{ __('Choose your color') }}</label>
                        </div>
                        <x-input-error for="color" class="mt-2" />

                        <x-button class="mt-4">
                            {{ __('Save') }}
                        </x-button>

                        @if($id)
                            <x-danger-button class="mt-4" wire:click="delete"
                                wire:confirm="{{ __('Are you sure you want to delete this tag? It cannot be recovered.') }}">
                                {{ __('Delete') }}
                            </x-danger-button>
                        @endif
                    </form>

                    <div class="mt-5">
                        <x-label for="existing-tags" value="{{ __('Existing Tags') }}" />
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('You can click on a tag and edit or delete it.') }}
                        </p>
                        <div class="flex flex-row gap-3 flex-wrap mt-2 mb-1">
                            @foreach ($allTags as $tag)
                                <a href="{{ route('tags.edit', $tag->id) }}"
                                    class="text-blue-500 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-400">
                                    <x-tag-card :tag="$tag" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>