<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="profilePassword">
    <header class="profilePassword__header">
        <h2 class="profilePassword__header__title">
            {{ __('Changer votre mot de passe') }}
        </h2>

        <p class="profilePassword__header__text">
            {{ __("Assurez vous d'utiliser un bon mot de passe") }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="">
        <div class="form__password">
            <x-input-label for="update_password_current_password" :value="__('Mot de passe')" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="" />
        </div>

        <div class="form__password">
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="" />
        </div>

        <div class="form__password">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmation du mot de passe')" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="" />
        </div>

        <div class="form__buttonContainer">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            <x-action-message class="button" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
