<div x-data="{ registerModal: @entangle('show') }">
    <div @click="registerModal = true" class="button login-button">Créer un compte</div>
    <div x-show="registerModal" class="modal">
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
                        <span class="modal__contentContainer__content__splitter__left__register">Vous avez déja un compte ?
                            <a
                                {{--                                href="{{route('register')}}" wire:navigate--}}
                                @click="registerModal = false"
                            > connectez-vous !</a>
                        </span>
                    </div>
                    <div class="modal__contentContainer__content__splitter__right">
                        {{--     Right part   --}}
                        <a @click="registerModal = false" class="modal__contentContainer__content__splitter__right__closeContainer">
                            <svg class="modal__contentContainer__content__splitter__right__closeContainer__svg">
                                <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                            </svg>
                        </a>
                        <div class="modal__contentContainer__content__splitter__right__formContainer">
                            {{--   Form  --}}
                            <form wire:submit="register" class="register__contentContainer__right__formContainer__form form">
                                <!-- Avatar -->
                                <div class="form__avatar">
                                    <div class="form__avatar__preview">
                                        @if ($uploadFile)
                                            <img src="{{ $uploadFile->temporaryUrl() }}" class="form__avatar__preview__img" alt="avatar">
                                        @else
                                            <img src="{{asset("images/defaultavatar.jpg")}}" class="form__avatar__preview__img" alt="avatar">
                                        @endif
                                    </div>

                                    <label class="form__avatar__label" for="form__avatar__label__iconWrapper__input">
                                        <div class="form__avatar__label__iconWrapper">
                                            <input type="file" wire:model="uploadFile" id="form__avatar__label__iconWrapper__input"/>
                                            <svg class="form__avatar__label__iconWrapper__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                            </svg>
                                        </div>
                                    </label>

                                    @error('uploadFile') <span class="error">{{ $message }}</span> @enderror
                                </div>

                                <div class="form__columns">
                                    <!-- Firstname -->
                                    <div class="form__firstname">
                                        <x-input-label for="firstname" :value="__('Prénom')"/>
                                        <x-text-input wire:model="firstname" id="firstname" type="text" name="firstname" placeholder="{{__('ex: Louis')}}"
                                                      required autocomplete="firstname"/>
                                        <x-input-error :messages="$errors->get('firstname')"/>
                                    </div>

                                    <!-- Lastname -->
                                    <div class="form__lastname">
                                        <x-input-label for="lastname" :value="__('Nom')"/>
                                        <x-text-input wire:model="lastname" id="lastname" type="text" name="lastname" placeholder="{{__('ex: Dupont')}}"
                                                      required autocomplete="lastname"/>
                                        <x-input-error :messages="$errors->get('lastname')"/>
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="form__email">
                                    <x-input-label for="email" :value="__('Email')"/>
                                    <x-text-input wire:model="email" id="email" type="email" name="email" required placeholder="{{__('ex: louisdupont@gmail.com')}}"
                                                  autocomplete="username"/>
                                    <x-input-error :messages="$errors->get('email')"/>
                                </div>

                                <!-- Password -->
                                <div class="form__password">
                                    <x-input-label for="password" :value="__('Mot de passe')"/>

                                    <x-text-input wire:model="password" id="password"
                                                  type="password"
                                                  name="password"
                                                  placeholder="{{__('Votre mot de passe ici')}}"
                                                  required autocomplete="new-password"/>

                                    <x-input-error :messages="$errors->get('password')"/>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form__password">
                                    <x-input-label for="password_confirmation" :value="__('Confirmation du mot de passe')"/>

                                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                                  type="password"
                                                  name="password_confirmation"
                                                  placeholder="{{__('Votre mot de passe ici')}}"
                                                  required autocomplete="new-password"/>

                                    <x-input-error :messages="$errors->get('password_confirmation')"/>
                                </div>

                                <div class="form__buttonContainer">
                                    <x-primary-button >
                                        {{ __("Inscription") }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
