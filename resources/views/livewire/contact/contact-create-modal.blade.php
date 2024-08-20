<div>

    {{--  FLASH MESSAGES  --}}
    @if (session('success'))
        <div class="flash">
            <div class="flash__container">
                @if (session('success'))
                    <div class="flash__container__type flash__container__type--success"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 8000)"
                         x-show="show">
                        <p class="flash__container__type__name">
                            {{__('Successfully created')}}
                        </p>
                        <p class="flash__container__type__message">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif
    {{--  END FLASH MESSAGES  --}}

    <a wire:click="openModal" class="button">{{__('Create a contact')}}</a>
    @if($isOpen)
        <div class="modal" wire:keydown.escape.window="closeModal" wire:click.self="closeModal">
            <div class="modal__contentContainer">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="create" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Create a contact")}}</h2>

                            <!-- Avatar -->
                            <div class="form__avatar">
                                <div class="form__avatar__preview">
                                    @if($form->avatar)
                                        <img src="{{ $form->avatar->temporaryUrl() }}" class="form__avatar__preview__img" alt="avatar">
                                    @else
                                        <img src="{{ asset('images/defaultavatar.jpg') }}" class="form__avatar__preview__img" alt="avatar">
                                    @endif
                                </div>

                                <label class="form__avatar__label" for="form__avatar__label__iconWrapper__input">
                                    <div class="form__avatar__label__iconWrapper">
                                        <input type="file" wire:model="form.avatar" id="form__avatar__label__iconWrapper__input"/>
                                        <svg class="form__avatar__label__iconWrapper__icon">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </div>
                                </label>

                                <x-input-error :messages="$errors->get('form.avatar')"/>
                            </div>

                            <!-- Firstname -->
                            <div class="form__firstname">
                                <x-input-label for="firstname" :value="__('Firstname')" />
                                <x-text-input wire:model="form.firstname" id="firstname" type="text" name="firstname" required autocomplete="firstname"  placeholder="{{__('ex: Léo')}}"/>
                                <x-input-error :messages="$errors->get('form.firstname')"/>
                            </div>

                            <!-- lastname -->
                            <div class="form__lastname">
                                <x-input-label for="lastname" :value="__('Lastname')" />
                                <x-text-input wire:model="form.lastname" id="lastname" type="text" name="lastname" required autocomplete="lastname"  placeholder="{{__('ex: Dubois')}}"/>
                                <x-input-error :messages="$errors->get('form.lastname')"/>
                            </div>

                            <!-- email -->
                            <div class="form__email">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="form.email" id="email" type="email" name="email" required autocomplete="email"  placeholder="{{__('ex: leodubois@gmail.com')}}"/>
                                <x-input-error :messages="$errors->get('form.email')"/>
                            </div>

                            <!-- button -->
                            <div class="form__buttonContainer">
                                <button type="submit" class="button">{{__('Save this contact')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
