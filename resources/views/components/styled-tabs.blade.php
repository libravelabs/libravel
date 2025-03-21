@props([
    'id' => 'tabs-' . uniqid(),
    'defaultTab' => null,
    'tabs' => [],
    'hasIcons' => false,
])

<div x-data="{ selectedTab: '{{ $defaultTab ?? array_key_first($tabs) }}' }" class="w-full">
    {{-- Tab Navigation --}}
    <div class="flex justify-center">
        <div class="inline-flex items-center justify-center flex-wrap gap-2 px-4 py-3">
            @foreach ($tabs as $name => $tab)
                <button x-on:click="selectedTab = '{{ $name }}'"
                    x-bind:aria-selected="selectedTab === '{{ $name }}'"
                    x-bind:tabindex="selectedTab === '{{ $name }}' ? '0' : '-1'"
                    x-bind:class="selectedTab === '{{ $name }}' ?
                        'bg-light-primary dark:bg-dark-accent-secondary text-white font-medium' :
                        'bg-light-bg-tertiary dark:bg-dark-bg-tertiary text-neutral-400 hover:bg-light-bg-secondary hover:dark:bg-dark-bg-secondary transition-colors duration-200'"
                    class="px-4 py-2 rounded-full" type="button" role="tab"
                    aria-controls="tabpanel-{{ $id }}-{{ $name }}">
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- Tab Content --}}
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
