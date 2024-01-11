<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="appBody">
        <div class="appBody__contentContainer">
            <livewire:layout.navigation />

            <!-- Page Heading -->
{{--            @if (isset($header))--}}
{{--                <header class="">--}}
{{--                    <div class="">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

            <!-- Page Content -->
            <main class="appBody__contentContainer__main">
                @php($currentUser = Auth()->user())
                <div class="appBar">
                    <div class="appBar__contentContainer">
                        <div class="appBar__contentContainer__searchContainer">
                            <div class="appBar__contentContainer__searchContainer__iconContainer">
                                <svg>
                                    <use xlink:href="{{asset("images/sprite.svg#search")}}"></use>
                                </svg>
                            </div>
                            <input type="text" class="appBar__contentContainer__searchContainer__input" placeholder="{{__('Votre recherche ...')}}">
                        </div>

                        <x-dropdown-link class="appBar__contentContainer__profileContainer" :href="route('profile')" wire:navigate>
                            <div class="appBar__contentContainer__profileContainer__nameContainer">
                                <span class="appBar__contentContainer__profileContainer__nameContainer__name">{{'Bonjour, '.$currentUser['firstname']}}</span>
                            </div>
                            <div class="appBar__contentContainer__profileContainer__imgContainer">
                                <img src="{{URL::to('/storage/avatars')."/".$currentUser['avatar']}}" alt="" class="appBar__contentContainer__profileContainer__imgContainer__img">
                            </div>
                        </x-dropdown-link>
                    </div>
                </div>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
