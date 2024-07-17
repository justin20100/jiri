<div x-data="{ open: @entangle('show') }">
    <div @click="open = true" class="button button--light login-button">Se connecter</div>

    <div x-show="open" class="modal">
        <div class="modal__contentContainer">

            <div class="modal__contentContainer__left">
                {{--     Left part          --}}
            </div>

            <div class="modal__contentContainer__right">
                {{--     Right part          --}}
            </div>
            
            <div class="">
                <button @click="open = false" class="">&times;</button>
            </div>
            <form wire:submit="login" class="login__contentContainer__right__form form">
                <!-- Email Address -->
                <div class="form__email">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input wire:model="form.email" id="email" type="email" name="email" required
                                  autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')"/>
                </div>

                <!-- Password -->
                <div class="form__password">
                    <x-input-label for="password" :value="__('Mot de passe')"/>

                    <x-text-input wire:model="form.password" id="password" type="password"
                                  name="password" required autocomplete="current-password"/>

                    <x-input-error :messages="$errors->get('password')"/>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate
                           class="form__password__forgot">
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


            {{--            <form wire:submit.prevent="login">--}}
            {{--                <div>--}}
            {{--                    <x-input-label for="email" :value="__('Email')"/>--}}
            {{--                    <x-text-input wire:model="form.email" id="email" type="email" name="email" required--}}
            {{--                                  autocomplete="username"/>--}}
            {{--                    <x-input-error :messages="$errors->get('email')"/>--}}
            {{--                </div>--}}

            {{--                <div class="mt-4">--}}
            {{--                    <x-input-label for="password" :value="__('Mot de passe')"/>--}}
            {{--                    <x-text-input wire:model="form.password" id="password" type="password" name="password" required--}}
            {{--                                  autocomplete="current-password"/>--}}
            {{--                    <x-input-error :messages="$errors->get('password')"/>--}}
            {{--                </div>--}}

            {{--                <div class="mt-4">--}}
            {{--                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">--}}
            {{--                        {{ __('Se connecter') }}--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--            </form>--}}
        </div>
    </div>
</div>
