<div x-data="{ open: @entangle('show') }">
    <div @click="open = true" class="button button--light login-button">Se connecter</div>
    <div x-show="open" class="modal">
        <div class="modal__contentContainer">
            <div class="modal__contentContainer__content">
                <div class="modal__contentContainer__content__splitter">
                    {{--     Splitter    --}}
                    <div class="modal__contentContainer__content__splitter__left">
                        <img src="{{asset('/images/welcome/welcome-fifth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--first">
                        <img src="{{asset('/images/welcome/welcome-sixth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--second">
                        {{--     Left part      --}}
                        <p class="modal__contentContainer__content__splitter__left__welcome">Bienvenue&nbsp;!</p>
                        <a href="/" wire:navigate class="modal__contentContainer__content__splitter__left__logo">
                            <x-application-logo/>
                        </a>
                        <span class="modal__contentContainer__content__splitter__left__register">Pas encore de compte ? <a href="{{route('register')}}" wire:navigate> Inscrivez-vous !</a></span>
                    </div>
                    <div class="modal__contentContainer__content__splitter__right">
                        {{--     Right part   --}}
                        <a @click="open = false" class="modal__contentContainer__content__splitter__right__closeContainer">
                            <svg class="modal__contentContainer__content__splitter__right__closeContainer__svg">
                                <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                            </svg>
                        </a>
                        {{--   Form  --}}
                        <div class="modal__contentContainer__content__splitter__right__formContainer">
                            <form wire:submit="login" class="modal__contentContainer__content__splitter__right__formContainer__form form">
                                <h2 class="modal__contentContainer__content__splitter__right__formContainer__form__title">{{__("Connectez-vous")}}</h2>
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
                        </div>
                    </div>
                </div>
            </div>
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
