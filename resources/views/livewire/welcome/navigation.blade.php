<div class="header__contentContainer__content__links">
    @auth
        <a href="{{ url('/dashboard') }}" wire:navigate>Dashboard</a>
    @else
        <a class="button button--light" href="{{ route('login') }}" wire:navigate>Connexion</a>

        @if (Route::has('register'))
            <a class="button" href="{{ route('register') }}" wire:navigate>Créer un compte</a>
        @endif
    @endauth
</div>
