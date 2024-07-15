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
<body class="appSimple">
<div class="wrapper">
    <div class="appSimple__contentContainer">
        <!-- Page Content -->
        <main class="appSimple__contentContainer__main">
            @php($currentUser = Auth()->user())
            <div class="appBarSimple">
                <div class="appBarSimple__contentContainer">
                    <div class="appBarSimple__contentContainer__logoContainer">
                        <a href="{{ route('dashboard') }}" wire:navigate class="appBarSimple__contentContainer__logoContainer__link">
                            <x-application-logo />
                        </a>
                    </div>
                    <x-dropdown-link class="appBarSimple__contentContainer__profileContainer" :href="route('profile')" wire:navigate>
                        <div class="appBarSimple__contentContainer__profileContainer__nameContainer">
                            <span class="appBarSimple__contentContainer__profileContainer__nameContainer__name">{{'Bonjour, '.$currentUser['firstname']}}</span>
                        </div>
                        <div class="appBarSimple__contentContainer__profileContainer__imgContainer">
                            <img src="{{URL::to('/storage/avatars')."/".$currentUser['avatar']}}" alt="" class="appBarSimple__contentContainer__profileContainer__imgContainer__img">
                        </div>
                    </x-dropdown-link>
                </div>
            </div>
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
