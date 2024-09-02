<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="navigation">
    <!-- Primary Navigation Menu -->
    <div class="wrapper">
        <div class="navigation__contentContainer">
            <div class="navigation__contentContainer__top">
                <!-- Logo -->
                <div class="navigation__contentContainer__top__logoContainer">
                    <a href="{{ route('jiris.index') }}" wire:navigate class="navigation__contentContainer__top__logoContainer__link">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="navigation__contentContainer__top__links">
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>--}}
{{--                        <div class="navigation__contentContainer__top__links__item__iconContainer">--}}
{{--                            <svg>--}}
{{--                                <use xlink:href="{{asset("images/sprite.svg#dashboard")}}"></use>--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                        <span>--}}
{{--                            {{ __('Dashboard') }}--}}
{{--                        </span>--}}
{{--                    </x-nav-link>--}}
                    <x-nav-link :href="route('jiris.index')" :active="request()->routeIs('jiris.index')" wire:navigate>
                        <div class="navigation__contentContainer__top__links__item__iconContainer">
                            <svg>
                                <use xlink:href="{{asset("images/sprite.svg#jiris")}}"></use>
                            </svg>
                        </div>
                        <span>
                            {{ __('Jiris') }}
                        </span>
                    </x-nav-link>
                    <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')" wire:navigate>
                        <div class="navigation__contentContainer__top__links__item__iconContainer">
                            <svg>
                                <use xlink:href="{{asset("images/sprite.svg#contacts")}}"></use>
                            </svg>
                        </div>
                        <span>
                            {{ __('Contacts') }}
                        </span>
                    </x-nav-link>
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')" wire:navigate>
                        <div class="navigation__contentContainer__top__links__item__iconContainer">
                            <svg>
                                <use xlink:href="{{asset("images/sprite.svg#projects")}}"></use>
                            </svg>
                        </div>
                        <span>
                            {{ __('Projects') }}
                        </span>
                    </x-nav-link>
                </div>
            </div>

            <div class="navigation__contentContainer__bottom">
                <div class="navigation__contentContainer__bottom__buttonContainer">
                    <!-- Authentication -->
                    <button wire:click="logout" class="navigation__contentContainer__bottom__buttonContainer__button">
                        <x-dropdown-link>
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </button>
                </div>
            </div>

{{--            <!-- Settings Dropdown -->--}}
{{--            <div class="">--}}
{{--                <x-dropdown align="right" width="48">--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <button class="">--}}
{{--                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>--}}

{{--                            <div class="">--}}
{{--                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}

{{--                    <x-slot name="content">--}}
{{--                        <x-dropdown-link :href="route('profile')" wire:navigate>--}}
{{--                            {{ __('Profile') }}--}}
{{--                        </x-dropdown-link>--}}

{{--                        <!-- Authentication -->--}}
{{--                        <button wire:click="logout" class="">--}}
{{--                            <x-dropdown-link>--}}
{{--                                {{ __('Log Out') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}
{{--                </x-dropdown>--}}
{{--            </div>--}}

            <!-- Hamburger -->
{{--            <div class="">--}}
{{--                <button @click="open = ! open" class="">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="">--}}
{{--            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-responsive-nav-link>--}}
{{--        </div>--}}

{{--        <!-- Responsive Settings Options -->--}}
{{--        <div class="">--}}
{{--            <div class="">--}}
{{--                <div class="" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>--}}
{{--                <div class="">{{ auth()->user()->email }}</div>--}}
{{--            </div>--}}

{{--            <div class="">--}}
{{--                <x-responsive-nav-link :href="route('profile')" wire:navigate>--}}
{{--                    {{ __('Profile') }}--}}
{{--                </x-responsive-nav-link>--}}

{{--                <!-- Authentication -->--}}
{{--                <button wire:click="logout" class="">--}}
{{--                    <x-responsive-nav-link>--}}
{{--                        {{ __('Log Out') }}--}}
{{--                    </x-responsive-nav-link>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</nav>
