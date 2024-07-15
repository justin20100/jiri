<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>


<main class="resetPasswordPage">
    <div class="resetPassword">
        <div class="wrapper">
            <div class="resetPassword__contentContainer">
                <div class="resetPassword__contentContainer__left">
                    <a href="/" wire:navigate class="resetPassword__contentContainer__left__logo">
                        <x-application-logo />
                    </a>
                    <div class="resetPassword__contentContainer__left__blueFilter"></div>
                    <img src="{{asset("images/auth-bg.jpg")}}" alt="" class="resetPassword__contentContainer__left__bgImage">
                </div>
                <div class="resetPassword__contentContainer__right">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="resetPassword__contentContainer__right__formContainer">

                        <h1 class="resetPassword__contentContainer__right__formContainer__title">Réinitialisation du mot de passe</h1>
                        <form wire:submit="sendPasswordResetLink">
                            <!-- Email Address -->
                            <div class="form__email">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="email" id="email" class="" placeholder="ex: dupontlouis@gmail.com" type="email" name="email" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="" />
                            </div>

                            <div class="form__buttonContainer">
                                <x-primary-button>
                                    {{ __('Recevoir un email de réinitialisation') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <a class="resetPassword__contentContainer__right__login" href="{{route('login')}}" wire:navigate>
                        Vous avez déja un compte ? Connectez-vous !
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
