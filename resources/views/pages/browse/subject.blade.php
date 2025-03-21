@php
    $books = \App\Models\Book::where('is_education', true)->paginate(30);
    $faviconUrl = SettingsHelper::getInfos('favicon');
@endphp

@extends('layouts.app', ['nav' => false])
@section('title', ucfirst(__('navigation/navigation.browse.subject.page.label')) . ' - ')

@section('content')
    @include('layouts.navbar')

    <main class="font-geist-sans bg-[#f7ede4] dark:bg-[#101110]">
        <x-browse::layout :datas="$books" :title="__('navigation/navigation.browse.subject.desc')" icon="bulb" />
    </main>

    <div class="px-4 md:px-16 py-32 bg-[#f7ede4] dark:bg-[#101110]">
        @include('pages.landing-page.layouts.footer', [
            'title' => __('navigation/navigation.jumbotron.subtitle_2'),
        ])
    </div>
@endsection
