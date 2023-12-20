<div class="header__contentContainer__content__links">
    @auth
        <div class="button header__contentContainer__content__links__button">
            <a href="{{ url('/dashboard') }}" wire:navigate>Dashboard</a>
        </div>
    @else
        <div class="button header__contentContainer__content__links__button">
            <a href="{{ route('login') }}" wire:navigate>Log in</a>
        </div>

        @if (Route::has('register'))
            <div class="button header__contentContainer__content__links__button">
                <a href="{{ route('register') }}" wire:navigate>Register</a>
            </div>
        @endif
    @endauth
</div>
