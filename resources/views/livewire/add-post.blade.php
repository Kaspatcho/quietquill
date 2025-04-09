<div class="dark:bg-gray-800 dark:text-white">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            {{ __('Add Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-900">
                <div class="container px-4 md:px-6 py-3">
                    <div x-data="{ activeTab: 'editor' }">
                        <div class="flex bg-gray-100 p-2 dark:bg-gray-700 dark:text-white">
                            <button
                                class="flex-1 py-2 px-4 font-bold text-sm uppercase transition duration-150 ease-in-out"
                                :class="{ 'bg-white border-b-2 border-blue-500 dark:bg-gray-700 dark:border-indigo-400': activeTab === 'editor' }"
                                @click="activeTab = 'editor'">
                                {{ __('Editor') }}
                            </button>
                            <button
                                class="flex-1 py-2 px-4 font-bold text-sm uppercase transition duration-150 ease-in-out"
                                :class="{ 'bg-white border-b-2 border-blue-500 dark:bg-gray-700 dark:border-indigo-400': activeTab === 'preview' }"
                                @click="activeTab = 'preview'">
                                {{ __('Preview') }}
                            </button>
                        </div>

                        <div class="bg-white p-2 dark:bg-gray-900" x-show="activeTab === 'editor'">
                            <form wire:submit.prevent="save">
                                <x-label for="title" value="{{ __('Title') }}" />
                                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.live="title" required autofocus />
                                <x-input-error for="title" class="mt-2" />

                                <x-label for="body" value="{{ __('Body') }}" />
                                <textarea id="body" class="mt-1 block w-full dark:bg-gray-800 dark:text-white dark:focus:border-indigo-400" required rows="10" wire:model.live="body"></textarea>
                                <x-input-error for="body" class="mt-2" />

                                <x-button class="mt-4">
                                    {{ __('Save') }}
                                </x-button>

                                @if($id)
                                    <x-danger-button class="mt-4" wire:click="delete" wire:confirm="{{ __('Are you sure you want to delete this post? It cannot be recovered.') }}">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                @endif
                            </form>
                        </div>

                        <div class="bg-white p-2 dark:bg-gray-900" x-show="activeTab === 'preview'">
                            <x-post :title="$title" :body="$body" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
