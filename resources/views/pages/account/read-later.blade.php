@extends('layouts.app')
@section('title', __('account.page.read_later.title') . ' -')

@section('content')
    <x-container class="flex-col gap-8 py-0">
        <div
            class="sticky top-16 z-50 flex flex-col bg-light-bg-primary dark:bg-dark-bg-primary py-4 border-b border-black dark:border-white">
            <h1
                class="font-semibold font-geist-sans text-5xl mx-auto border-2 border-white px-8 py-2 rounded-3xl box-shadow-purple">
                {{ __('account.page.read_later.title') }}</h1>
            @if ($books->hasMorePages())
                <div class="mt-8">
                    {{ $books->links('pagination.paginator') }}
                </div>
            @endif
        </div>
        <x-grids :datas="$books" />
    </x-container>
@endsection
