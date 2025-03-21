@props([
    'type' => ['full', 'icon', 'name'],
])

@php
    $siteInfo = \App\Helpers\SettingsHelper::getInfos();
    $faviconUrl = SettingsHelper::getInfos('favicon');
@endphp

@switch($type)
    @case('icon')
        <div class="relative flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-library-big">
                <rect width="8" height="18" x="3" y="3" rx="1" />
                <path d="M7 3v18" />
                <path
                    d="M20.4 18.9c.2.5-.1 1.1-.6 1.3l-1.9.7c-.5.2-1.1-.1-1.3-.6L11.1 5.1c-.2-.5.1-1.1.6-1.3l1.9-.7c.5-.2 1.1.1 1.3.6Z" />
            </svg>
        </div>
    @break

    @case('name')
        <div>
            <h1 class="text-2xl font-semibold font-afacad-flux">{{ $siteInfo['shortname'] }}</h1>
        </div>
    @break

    @default
        <div class="flex items-center gap-1">
            @if ($faviconUrl)
                <img src="{{ $faviconUrl }}" alt="{{ $siteInfo['shortname'] }}" class="w-6 h-auto mr-1" />
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-library-big">
                    <rect width="8" height="18" x="3" y="3" rx="1" />
                    <path d="M7 3v18" />
                    <path
                        d="M20.4 18.9c.2.5-.1 1.1-.6 1.3l-1.9.7c-.5.2-1.1-.1-1.3-.6L11.1 5.1c-.2-.5.1-1.1.6-1.3l1.9-.7c.5-.2 1.1.1 1.3.6Z" />
                </svg>
            @endif
            <h1 class="text-2xl font-semibold font-afacad-flux">{{ $siteInfo['shortname'] }}</h1>
        </div>
@endswitch
