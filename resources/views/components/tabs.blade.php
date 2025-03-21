@props([
    'id' => 'tabs-' . uniqid(),
    'defaultTab' => null,
    'tabs' => [],
    'hasIcons' => false,
    'wireModelName' => null,
    'isLivewire' => false,
    'border' => true,
])

@if ($isLivewire)
    <div x-data="{ selectedTab: '{{ $defaultTab ?? array_key_first($tabs) }}' }" class="w-full">
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-outline dark:border-outline-dark {{ $user ? 'sticky top-14 md:top-16 z-20' : 'sticky top-0 z-20' }} bg-light-bg-primary dark:bg-dark-bg-primary {{ $border ? 'px-4' : '' }}"
            role="tablist" aria-label="tab options">
            @foreach ($tabs as $name => $tab)
                <button
                    @if ($wireModelName) wire:click="{{ $wireModelName }}('{{ $name }}')" @endif
                    x-on:click="selectedTab = '{{ $name }}'"
                    x-bind:aria-selected="selectedTab === '{{ $name }}'"
                    x-bind:tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
                    x-bind:class="selectedTab === '{{ $name }}' ?
                        'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' :
                        'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                    class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                    aria-controls="tabpanel-{{ $id }}-{{ $name }}">
                    @if ($hasIcons && isset($tab['icon']))
                        {!! $tab['icon'] !!}
                    @endif
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
        @if ($border)
            <div class="mt-2 w-full h-1 border-b border-b-neutral-800 dark:border-b-neutral-400"></div>
        @endif
        <div class="px-2 py-4 text-on-surface dark:text-on-surface-dark">
            @foreach ($tabs as $name => $tab)
                <div x-cloak x-show="selectedTab === '{{ $name }}'"
                    id="tabpanel-{{ $id }}-{{ $name }}" role="tabpanel"
                    aria-label="{{ $name }}">
                    @if (isset(${'tab_' . $name}))
                        {{ ${'tab_' . $name} }}
                    @elseif(isset($tab['content']))
                        {!! $tab['content'] !!}
                    @else
                        <div class="p-4">Tab content for {{ $tab['label'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@else
    <div x-data="{ selectedTab: '{{ $defaultTab ?? array_key_first($tabs) }}' }" class="w-full">
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto {{ $user ? 'sticky top-14 md:top-16 z-20' : 'sticky top-0 z-20' }} bg-light-bg-primary dark:bg-dark-bg-primary {{ $border ? 'px-4' : '' }}"
            role="tablist" aria-label="tab options">
            @foreach ($tabs as $name => $tab)
                <button x-on:click="selectedTab = '{{ $name }}'"
                    x-bind:aria-selected="selectedTab === '{{ $name }}'"
                    x-bind:tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
                    x-bind:class="selectedTab === '{{ $name }}' ?
                        'font-bold text-light-text-primary border-b-2 border-light-text-primary dark:border-dark-text-primary dark:text-dark-text-primary' :
                        'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
                    class="flex h-min items-center gap-2 px-4 py-2 text-sm" type="button" role="tab"
                    aria-controls="tabpanel-{{ $id }}-{{ $name }}">
                    @if ($hasIcons && isset($tab['icon']))
                        {!! $tab['icon'] !!}
                    @endif
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
        @if ($border)
            <div class="mt-2 w-full h-1 border-b border-b-neutral-800 dark:border-b-neutral-400"></div>
        @endif
        <div class="px-2 py-4 text-on-surface dark:text-on-surface-dark">
            @foreach ($tabs as $name => $tab)
                <div x-cloak x-show="selectedTab === '{{ $name }}'"
                    id="tabpanel-{{ $id }}-{{ $name }}" role="tabpanel"
                    aria-label="{{ $name }}">
                    @if (isset($tab['content']))
                        {!! $tab['content'] !!}
                    @elseif(isset(${'tab_' . $name}))
                        {{ ${'tab_' . $name} }}
                    @else
                        <div class="p-4">Tab content for {{ $tab['label'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
