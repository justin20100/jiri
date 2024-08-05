<form wire:submit="login" class="modal__contentContainer__content__splitter__right__formContainer__form form">
    <h2 class="modal__contentContainer__content__splitter__right__formContainer__form__title">{{__("Connectez-vous")}}</h2>
    <!-- Email Address -->
    <div class="form__email">
        <x-input-label for="email" :value="__('Email')"/>
        <x-text-input wire:model="form.email" id="email" type="email" name="email" required placeholder="{{__('ex: louisdupont@gmail.com')}}" autocomplete="username"/>
        <x-input-error :messages="$errors->get('email')"/>
    </div>
    <!-- Password -->
    <div class="form__password">
        <x-input-label for="password" :value="__('Mot de passe')"/>
        <x-text-input wire:model="form.password" id="password"
                      type="{{ $this->passwordVisible ? 'text' : 'password' }}"
                      name="password"
                      required
                      placeholder="{{__('Votre mot de passe ici')}}"
                      autocomplete="current-password"/>
        <div class="form__password__visibility">
            <button wire:click.prevent="togglePasswordVisibility" class="form__password__visibility__button">
                <svg class="form__password__visibility__button__svg">
                    <use xlink:href="{{asset("images/sprite.svg#trash")}}"></use>
                </svg>
            </button>
        </div>
        <x-input-error :messages="$errors->get('password')"/>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" wire:navigate class="form__password__forgot">{{ __('Mot de passe oublié ?') }}</a>
        @endif
    </div>

    <div class="form__buttonContainer">
        <x-primary-button>
            {{ __('Se connecter') }}
        </x-primary-button>
    </div>
</form>
