<div>

<form wire:submit="sendPasswordResetLink" class="modal__contentContainer__content__splitter__right__formContainer__form form">
    <h2 class="modal__contentContainer__content__splitter__right__formContainer__form__title">{{__("Reset password")}}</h2>

    <!-- Email Address -->
    <div class="form__email">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input wire:model="email" id="email" class="" placeholder="ex: dupontlouis@gmail.com" type="email" name="email" required autofocus />
        <x-input-error :messages="$errors->get('email')" class="" />
    </div>

    <div class="form__buttonContainer">
        <x-primary-button>
            {{ __('Send reset email') }}
        </x-primary-button>
    </div>
</form>
</div>

