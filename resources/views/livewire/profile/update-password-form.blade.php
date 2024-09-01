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
    public bool $passwordVisible = false;

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

        $this->dispatch('flashMessage', 'success', __("Password updated successfully"));
//        $this->dispatch('password-updated');

    }

    public function togglePasswordVisibility(): void
    {
        $this->passwordVisible = ! $this->passwordVisible;
    }
}; ?>

<section class="profilePassword">
    <header class="profilePassword__header">
        <h2 class="profilePassword__header__title">
            {{ __('Change your password') }}
        </h2>

        <p class="profilePassword__header__text">
            {{ __("Make sure to use a long and strong password !") }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="">
        <div class="form__password">
            <x-input-label for="update_password_current_password" :value="__('Password')" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="{{ $this->passwordVisible ? 'text' : 'password' }}" class="" autocomplete="current-password" />
            <div class="form__password__visibility">
                <button wire:click.prevent="togglePasswordVisibility" class="form__password__visibility__button">
                    <svg class="form__password__visibility__button__svg">
                        <use xlink:href="{{asset("images/sprite.svg#eye")}}"></use>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('current_password')" class="" />
        </div>

        <div class="form__password">
            <x-input-label for="update_password_password" :value="__('New password')" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="{{ $this->passwordVisible ? 'text' : 'password' }}" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="" />
        </div>

        <div class="form__password">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm password')" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="{{ $this->passwordVisible ? 'text' : 'password' }}" class="" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="" />
        </div>

        <div class="form__buttonContainer">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="button" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
