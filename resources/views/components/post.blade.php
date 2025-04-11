@props(['title' => null, 'body', 'tags' => []])
<div class="container px-4 md:px-6 flex flex-col">
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-2xl font-bold leading-tight mt-16 mb-6 text-center dark:text-white">
            {{ $title }}
        </h1>
        @if(!empty($tags))
            <div class="mt-4 flex flex-wrap justify-center space-x-2">
                @foreach($tags as $tag)
                    <x-tag-card :tag="$tag" />
                @endforeach
            </div>
        @endif
    </div>

    <div class="post-body dark:text-white">
        {!! Str::of($body)->trim()->markdown(['html_purifier' => true]) !!}
    </div>
</div>