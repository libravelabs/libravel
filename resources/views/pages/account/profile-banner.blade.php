@php
    $majors = \App\Models\Major::all();
@endphp

<div class="relative w-full text-light-text-primary dark:text-dark-text-primary">
    <!-- Banner Image with Gradient Overlay -->
    <div class="w-full h-72 overflow-hidden relative">
        <img src="/assets/lofi-bg.png" alt="Banner" class="w-full h-full object-cover rounded-xl opacity-70">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-light-bg-primary dark:from-dark-bg-primary to-transparent">
        </div>

        <!-- Joined and Edit buttons (top right) -->
        <div class="absolute top-4 right-4 flex items-center space-x-2">
            <div class="text-sm px-3 py-1 rounded-full bg-neutral-900 dark:bg-neutral-700 text-white bg-opacity-80">
                {{ __('profile.joined') . ' ' . $joined }}
            </div>
            <x-button bgColor="bg-yellow-500" x-on:click="selectedTab = 'account'">
                <i class="ti ti-edit"></i>
                Edit
            </x-button>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Profile Info Section (horizontal layout) -->
        <div class="relative -mt-32">
            <!-- Large Profile and Details in Row Layout -->
            <div class="hidden lg:flex items-start space-x-4">
                <!-- Profile Picture -->
                <div
                    class="group h-36 w-36 rounded-md overflow-hidden border-4 border-light-bg-primary dark:border-dark-bg-primary">
                    <x-avatar-display size="144" />
                    <div x-on:click="selectedTab = 'account'"
                        class="absolute inset-0 size-36 bg-black/50 dark:bg-black/70 text-white flex justify-center items-center rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                        <i class="ti ti-camera text-3xl"></i>
                    </div>
                </div>

                <!-- User Info -->
                <div class="pb-4 max-w-xl">
                    <p class="text-light-text-secondary dark:text-dark-text-secondary text-sm">
                        {{ $user->username }}
                    </p>
                    <h1 class="text-2xl font-semibold">{{ $user->fullname ?? $user->username }}</h1>

                    <div class="flex space-x-2 my-2 text-light-text-tertiary">
                        @if ($user->status)
                            <span class="font-medium">{{ __("members/fields.fields.status.$user->status") }}</span>
                        @endif
                        @if ($user->gender)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium">{{ __("members/fields.fields.gender.$user->gender") }}</span>
                        @endif
                        @if ($user->major)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium capitalize">
                                {{ $userMajor }}
                            </span>
                            <span class="font-bold mx-2">•</span>
                        @elseif ($user->isAdmin())
                            <span class="font-medium">{{ $user->isAdmin() ? 'Admin' : '' }}</span>
                        @endif
                    </div>
                    @if ($user->bio)
                        <x-show-more :text="$user->bio" />
                    @endif
                </div>
            </div>

            <!-- Mobile Profile and Details in Row Layout -->
            <div class="flex lg:hidden flex-col items-center justify-center w-full">
                <div
                    class="h-36 w-36 rounded-md overflow-hidden border-[6px] border-light-bg-primary dark:border-dark-bg-primary mx-auto">
                    <x-avatar-display size="144" />
                </div>

                <!-- User Info -->
                <div class="pb-4 mx-auto text-center">
                    <p class="text-light-text-secondary dark:text-dark-text-secondary text-sm">
                        {{ $user->username }}
                    </p>
                    <h1 class="text-2xl font-semibold">{{ $user->fullname ?? $user->username }}</h1>

                    <div class="flex space-x-2 my-2 justify-center text-light-text-tertiary">
                        @if ($user->status)
                            <span class="font-medium">{{ __("members/fields.fields.status.$user->status") }}</span>
                        @endif
                        @if ($user->gender)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium">{{ __("members/fields.fields.gender.$user->gender") }}</span>
                        @endif
                        @if ($user->major)
                            <span class="font-bold mx-2">•</span>
                            <span class="font-medium capitalize">
                                {{ $userMajor }}
                            </span>
                            <span class="font-bold mx-2">•</span>
                        @elseif ($user->isAdmin())
                            <span class="font-medium">{{ $user->isAdmin() ? 'Admin' : '' }}</span>
                        @endif
                    </div>
                    @if ($user->bio)
                        <x-show-more :text="$user->bio" class="text-justify" />
                    @endif
                </div>
            </div>

            <x-account::reviews class="mt-8" :reviewUser="$user" />
        </div>
    </div>
</div>
