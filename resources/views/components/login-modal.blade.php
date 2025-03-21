@props([
    'open' => 'open',
])

<div class="flex flex-col mx-auto p-4 bg-light-bg-secondary dark:bg-dark-bg-secondary rounded-xl w-full max-w-xl">
    <button x-on:click="{{ $open }} = false" aria-label="close modal" class="ml-auto">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none"
            stroke-width="1.4" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="flex flex-col items-center gap-4 mx-auto w-full">
        <div class="flex flex-col gap-10 p-4 rounded-2xl w-full">
            <div class="space-y-2">
                <x-logo type="icon" />
                <h3 class="font-semibold text-lg max-w-52">{{ __('pages/login.greeting') }}</h3>
            </div>
            <livewire:login />
        </div>
    </div>
</div>
