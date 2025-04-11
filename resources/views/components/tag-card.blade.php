@props(['tag'])
<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold border text-black dark:text-white border-2"
    style="border-color: {{ $tag->color }}; background-color: {{ $tag->color }}40;">
    {{ $tag->name }}
</span>