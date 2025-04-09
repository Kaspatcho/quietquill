@props(['title' => null, 'body'])
<div class="container px-4 md:px-6 flex flex-col">
    <h1 class="text-2xl font-bold leading-tight mt-16 mb-6 text-center dark:text-white">
        {{ $title }}
    </h1>

    <div class="post-body dark:text-white">
        {!! Str::of($body)->trim()->markdown(['html_purifier' => true]) !!}
    </div>
</div>
