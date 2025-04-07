@props(['title', 'body'])
<div class="container px-4 md:px-6 flex flex-col">
    <h1 class="text-2xl font-bold leading-tight mt-16 mb-6 text-center">
        {{ $title }}
    </h1>

    <div class="post-body">
        {!! Str::of($body)->trim()->markdown(['html_purifier' => true]) !!}
    </div>
</div>