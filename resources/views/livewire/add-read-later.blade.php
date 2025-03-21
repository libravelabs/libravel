<div x-data="{ loginModal: false }">
    @if ($user)
        <div>
            @if (!$isReadLater)
                <x-button wire:click="addToReadLater" width="w-10" height="h-10"
                    class="inline-flex items-center gap-2 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-bookmark">
                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    </svg>
                </x-button>
            @else
                <x-button wire:click="removeFromReadLater" width="w-10" height="h-10"
                    class="inline-flex items-center gap-2 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-bookmark fill-white dark:fill-black">
                        <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                    </svg>
                </x-button>
            @endif
        </div>
    @else
        <x-button x-on:click="loginModal = !loginModal" width="w-10" height="h-10"
            class="inline-flex items-center gap-2 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-bookmark">
                <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
            </svg>
        </x-button>
        <x-modal open="loginModal">
            <x-login-modal open="loginModal" />
        </x-modal>
    @endif
</div>
