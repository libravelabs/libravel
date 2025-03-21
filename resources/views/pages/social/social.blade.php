@extends('layouts.app')
@section('title', $otheruser->username . ' -')

@section('content')
    <x-container class="py-0">
        <div class="mx-auto w-full">
            @php
                $majors = \App\Models\Major::all();
                $joined_at = \App\Helpers\TimeHelper::timeAgo($otheruser->created_at);
            @endphp

            <div class="relative w-full text-light-text-primary dark:text-dark-text-primary">
                <!-- Banner Image with Gradient Overlay -->
                <div class="w-full h-72 overflow-hidden relative">
                    <img src="/assets/lofi-bg.png" alt="Banner" class="w-full h-full object-cover rounded-xl opacity-70">
                    <!-- Gradient Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-light-bg-primary dark:from-dark-bg-primary to-transparent">
                    </div>

                    <!-- Joined and Edit buttons (top right) -->
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <div
                            class="text-sm px-3 py-1 rounded-full bg-neutral-900 dark:bg-neutral-700 text-white bg-opacity-80">
                            {{ __('profile.joined') . ' ' . $joined_at }}
                        </div>
                    </div>
                </div>

                <div class="relative -mt-32 px-8">
                    <!-- Large Profile and Details in Row Layout -->
                    <div class="hidden lg:flex items-start space-x-4">
                        <!-- Profile Picture -->
                        <div
                            class="group h-36 w-36 rounded-md overflow-hidden border-4 border-light-bg-primary dark:border-dark-bg-primary">
                            @if ($otheruser->avatar && $otheruser->avatar->getFirstMediaUrl('avatars'))
                                <img src="{{ $otheruser->avatar->getFirstMediaUrl('avatars') }}" alt="Avatar"
                                    class="rounded-sm size-[144px]" />
                            @elseif($otheruser->getFirstMediaUrl('user.avatar'))
                                <img src="{{ $otheruser->getFirstMediaUrl('user.avatar') }}" alt="Avatar"
                                    class="rounded-sm size-[144px]" />
                            @else
                                {!! $otheruser->getAvatar(144) !!}
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="pb-4 max-w-xl">
                            <p class="text-light-text-secondary dark:text-dark-text-secondary text-sm">
                                {{ $otheruser->username }}
                            </p>
                            <h1 class="text-2xl font-semibold">{{ $otheruser->fullname ?? $otheruser->username }}</h1>

                            <div class="flex space-x-2 my-2 text-light-text-tertiary">
                                @if ($otheruser->status)
                                    <span
                                        class="font-medium">{{ __("members/fields.fields.status.$otheruser->status") }}</span>
                                @endif
                                @if ($otheruser->gender)
                                    <span class="font-bold mx-2">•</span>
                                    <span
                                        class="font-medium">{{ __("members/fields.fields.gender.$otheruser->gender") }}</span>
                                @endif
                                @if ($otheruser->major)
                                    <span class="font-bold mx-2">•</span>
                                    <span class="font-medium capitalize">
                                        {{ $otheruserMajor }}
                                    </span>
                                    <span class="font-bold mx-2">•</span>
                                @elseif ($otheruser->isAdmin())
                                    <span class="font-medium">{{ $otheruser->isAdmin() ? 'Admin' : '' }}</span>
                                @endif
                            </div>
                            @if ($otheruser->bio)
                                <x-show-more :text="$otheruser->bio" />
                            @endif
                        </div>
                    </div>

                    <!-- Mobile Profile and Details in Row Layout -->
                    <div class="flex lg:hidden flex-col items-center justify-center w-full">
                        <div
                            class="h-36 w-36 rounded-md overflow-hidden border-[6px] border-light-bg-primary dark:border-dark-bg-primary mx-auto">
                            @if ($otheruser->avatar && $otheruser->avatar->getFirstMediaUrl('avatars'))
                                <img src="{{ $otheruser->avatar->getFirstMediaUrl('avatars') }}" alt="Avatar"
                                    class="rounded-sm size-[144px]" />
                            @elseif($otheruser->getFirstMediaUrl('user.avatar'))
                                <img src="{{ $otheruser->getFirstMediaUrl('user.avatar') }}" alt="Avatar"
                                    class="rounded-sm size-[144px]" />
                            @else
                                {!! $otheruser->getAvatar(144) !!}
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="pb-4 mx-auto text-center">
                            <p class="text-light-text-secondary dark:text-dark-text-secondary text-sm">
                                {{ $otheruser->username }}
                            </p>
                            <h1 class="text-2xl font-semibold">{{ $otheruser->fullname ?? $otheruser->username }}</h1>

                            <div class="flex space-x-2 my-2 justify-center text-light-text-tertiary">
                                @if ($otheruser->status)
                                    <span
                                        class="font-medium">{{ __("members/fields.fields.status.$otheruser->status") }}</span>
                                @endif
                                @if ($otheruser->gender)
                                    <span class="font-bold mx-2">•</span>
                                    <span
                                        class="font-medium">{{ __("members/fields.fields.gender.$otheruser->gender") }}</span>
                                @endif
                                @if ($otheruser->major)
                                    <span class="font-bold mx-2">•</span>
                                    <span class="font-medium capitalize">
                                        {{ $otheruserMajor }}
                                    </span>
                                    <span class="font-bold mx-2">•</span>
                                @elseif ($otheruser->isAdmin())
                                    <span class="font-medium">{{ $otheruser->isAdmin() ? 'Admin' : '' }}</span>
                                @endif
                            </div>
                            @if ($otheruser->bio)
                                <x-show-more :text="$otheruser->bio" class="text-justify" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <x-account::reviews class="mt-8" :reviewUser="$otheruser" :title="__('review.their_reviews', ['username' => $otheruser->username])" :no_reviews_message="__('review.they_haven\'t_review_any', ['username' => $otheruser->username])" />
        </div>
    </x-container>
@endsection
