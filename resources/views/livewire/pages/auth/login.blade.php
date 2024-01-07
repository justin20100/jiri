<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<main class="loginPage">
    <div class="login">
        <div class="wrapper">
            <div class="login__contentContainer">
                <div class="login__contentContainer__left">
                    <a href="/" wire:navigate class="login__contentContainer__left__logo">
                        <x-application-logo />
                    </a>
                    <div class="login__contentContainer__left__blueFilter"></div>
                    <img src="{{asset("images/auth-bg.jpg")}}" alt="" class="login__contentContainer__left__bgImage">
                </div>
                <div class="login__contentContainer__right">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <div class="login__contentContainer__right__formContainer">
                        <h1 class="login__contentContainer__right__formContainer__title">Connectez-vous</h1>
                        <form wire:submit="login" class="login__contentContainer__right__form form">
                            <!-- Email Address -->
                            <div class="form__email">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')"/>
                            </div>

                            <!-- Password -->
                            <div class="form__password">
                                <x-input-label for="password" :value="__('Mot de passe')" />

                                <x-text-input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password" />

                                <x-input-error :messages="$errors->get('password')"/>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" wire:navigate class="form__password__forgot">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Remember Me -->
{{--                            <div class="form__rememberMe">--}}
{{--                                <label for="remember">--}}
{{--                                    <input wire:model="form.remember" id="remember" type="checkbox" name="remember">--}}
{{--                                    <span>{{ __('Remember me') }}</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}

                            <div class="form__buttonContainer">
                                <x-primary-button>
                                    {{ __('Se connecter') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <a class="login__contentContainer__right__register" href="{{route('register')}}" wire:navigate>
                        Pas encore de compte ? Inscrivez-vous !
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
