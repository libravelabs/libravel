@props([
    'src' => null,
    'alt' => null,
    'title' => '',
    'subtitle' => '',
    'href' => null,
    'detail' => null,
])

@if ($href)
    <a href="{{ $href }}"
        class="flex flex-col bg-white dark:bg-black hover:bg-dark-bg-tertiary dark:hover:bg-light-bg-tertiary hover:text-white dark:hover:text-black transition-all duration-300 rounded-[2.5rem] p-4 gap-4">
        <x-image-skeleton :src="$src" :alt="$alt" class="w-full h-auto rounded-3xl" />
        <div class="px-4 pb-4 space-y-2">
            {{ $detail }}
            <h1 class="text-xl">{{ $title }}</h1>
            <span class="text-sm text-light-text-tertiary dark:text-dark-text-tertiary">{{ $subtitle }}</span>
        </div>
    </a>
@else
    <div
        class="flex flex-col bg-white dark:bg-black hover:bg-dark-bg-tertiary dark:hover:bg-light-bg-tertiary hover:text-white dark:hover:text-black transition-all duration-300 rounded-[2.5rem] p-4 gap-4">
        <x-image-skeleton :src="$src" :alt="$alt" class="w-full h-auto rounded-3xl" />
        <div class="px-4 pb-4 space-y-2">
            {{ $detail }}
            <h1 class="text-xl">{{ $title }}</h1>
            <span class="text-sm text-light-text-tertiary dark:text-dark-text-tertiary">{{ $subtitle }}</span>
        </div>
    </div>
@endif
