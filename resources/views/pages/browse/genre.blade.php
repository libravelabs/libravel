@php
    $genres = \App\Models\Genre::has('books')->paginate(30);

    $tabs = $genres->mapWithKeys(function ($genre) {
        return [
            $genre->key => [
                'label' => __('genres/genres.' . $genre->key),
                'icon' => "<i class='ti ti-{$genre->icon}'></i>",
            ],
        ];
    });
@endphp

@extends('layouts.app', ['nav' => false])
@section('title', ucfirst(__('book/fields.label.genres.label')) . ' - ')

@section('content')
    @include('layouts.navbar')

    <main class="font-geist-sans bg-[#f7ede4] dark:bg-[#101110]">
        <div class="relative flex flex-col xl:flex-row items-start justify-between gap-4 py-32 px-4 xl:px-20">
            <div class="relative xl:sticky w-full xl:max-w-xl z-50 xl:left-12 xl:top-28">
                <div class="max-w-full xl:max-w-2xl">
                    <div class="flex flex-col bg-white dark:bg-black rounded-[2.5rem] p-4 gap-4">
                        <div class="relative">
                            <x-image-skeleton src="/assets/cool-bgs/l@1080x1080.png" alt=""
                                class="w-full h-auto aspect-square rounded-3xl" />
                            <div class="absolute inset-0 flex justify-center items-center text-white">
                                <i class="ti ti-tags text-[200px]"></i>
                            </div>
                        </div>
                        <div class="px-4 pb-4 space-y-2">
                            <h1 class="text-xl">{{ __('navigation/navigation.browse.genre.desc') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-4xl">
                <x-styled-tabs :tabs="$tabs" :default-tab="$genres[0]->key" :has-icons="true" :border="false">
                    @foreach ($genres as $genre)
                        <x-slot :name="'tab_' . $genre->key">
                            <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 max-w-4xl">
                                @foreach ($genre->books->take(9) as $book)
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
                        </x-slot>
                    @endforeach
                </x-styled-tabs>
            </div>
        </div>
    </main>

    <div class="px-4 md:px-16 py-32 bg-[#f7ede4] dark:bg-[#101110]">
        @include('pages.landing-page.layouts.footer', [
            'title' => __('navigation/navigation.jumbotron.subtitle_1'),
        ])
    </div>
@endsection
