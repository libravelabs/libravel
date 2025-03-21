@props([
    'datas' => [],
    'imageBg' => '/assets/cool-bgs/l@1080x1080.png',
    'title' => '',
    'icon' => '',
])

@php
    $faviconUrl = SettingsHelper::getInfos('favicon');
@endphp

<div class="relative hidden lg:flex items-start justify-between gap-4 py-32 px-4 xl:px-20">
    <div class="relative xl:sticky w-full xl:max-w-xl z-50 xl:left-12 xl:top-28">
        <div class="max-w-2xl">
            <div class="flex flex-col bg-white dark:bg-black rounded-[2.5rem] p-4 gap-4">
                <div class="relative">
                    <x-image-skeleton :src="$imageBg" alt="" class="w-full h-auto aspect-square rounded-3xl" />
                    <div class="absolute inset-0 flex justify-center items-center text-white">
                        <i class="ti ti-{{ $icon }} text-[200px]"></i>
                    </div>
                </div>
                <div class="px-4 pb-4 space-y-2">
                    <h1 class="text-xl">{{ $title }}</h1>
                </div>
            </div>
            {{ $datas->links('pagination.grid') }}
        </div>
    </div>
    @if (count($datas) > 0)
        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 max-w-4xl">
            @foreach ($datas as $book)
                <x-card :src="$book->image_path" :title="$book->title" :subtitle="\Carbon\Carbon::parse($book->release_date)->format('F d, Y')"
                    href="{{ route('book.detail', [$book->id, $book->slug]) }}">
                    <x-slot name="detail">
                        @foreach ($book->genres as $genre)
                            <span
                                class="inline-flex py-1 px-2 bg-light-accent-secondary/30 dark:bg-dark-accent-primary/30 text-green-500 dark:text-orange-500 text-xs uppercase rounded-md">
                                {{ __('genres/genres.' . $genre->key) }}
                            </span>
                        @endforeach
                    </x-slot>
                </x-card>
            @endforeach
        </div>
    @endif
</div>

<div class="relative flex lg:hidden flex-col items-center justify-center py-16 px-4">
    <div class="w-full max-w-md">
        <div class="flex flex-col bg-white dark:bg-black rounded-3xl p-4 gap-4">
            <div class="relative">
                <x-image-skeleton :src="$imageBg" alt="" class="w-full h-auto aspect-square rounded-3xl" />
                <div class="absolute inset-0 flex justify-center items-center text-white">
                    <i class="ti ti-{{ $icon }} text-[100px]"></i>
                </div>
            </div>
            <div class="px-4 pb-4 space-y-2">
                <h1 class="text-xl text-center">{{ $title }}</h1>
            </div>
        </div>
        {{ $datas->links('pagination.grid') }}
    </div>
    @if (count($datas) > 0)
        <div class="grid grid-cols-2 gap-4 mt-8">
            @foreach ($datas as $book)
                <x-card :src="$book->image_path" :title="$book->title" :subtitle="\Carbon\Carbon::parse($book->release_date)->format('F d, Y')"
                    href="{{ route('book.detail', [$book->id, $book->slug]) }}">
                    <x-slot name="detail">
                        @foreach ($book->genres as $genre)
                            <span
                                class="inline-flex py-1 px-2 bg-light-accent-secondary/30 dark:bg-dark-accent-primary/30 text-green-500 dark:text-orange-500 text-xs uppercase rounded-md">
                                {{ __('genres/genres.' . $genre->key) }}
                            </span>
                        @endforeach
                    </x-slot>
                </x-card>
            @endforeach
        </div>
    @endif
</div>
