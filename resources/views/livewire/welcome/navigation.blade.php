<div class="header__contentContainer__content__links">
    @auth
        <a href="{{ url('/dashboard') }}" wire:navigate>Dashboard</a>
    @else
        @livewire('welcome.welcome-modal')
{{--        @livewire('auth.login-modal')--}}
{{--        <a class="button button--light" href="{{ route('login') }}" wire:navigate>Se connecter</a>--}}
{{--        @if (Route::has('register'))--}}
{{--            @livewire('auth.register-modal')--}}
{{--            <a class="button" href="{{ route('register') }}" wire:navigate>Créer un compte</a>--}}
{{--        @endif--}}
    @endauth
</div>
