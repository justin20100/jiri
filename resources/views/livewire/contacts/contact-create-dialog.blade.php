<div>
    <button wire:click="openDialog" class="button">{{__('Ajouter un contact')}}</button>
    @if($isOpen)
        <div class="dialog">
            <div class="dialog__contentContainer">
                <button wire:click="closeDialog" class="dialog__contentContainer__closeContainer">
                    <svg class="dialog__contentContainer__closeContainer__svg">
                        <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                    </svg>
                </button>
                <div class="dialog__contentContainer__formContainer">
                    <form wire:submit="create" class="form dialog__contentContainer__formContainer__form">
                        <h2 class="dialog__contentContainer__formContainer__form__title">{{__("Ajout d'un contact")}}</h2>

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

                            @error('form.avatar') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <!-- Firstname -->
                        <div class="form__firstname">
                            <x-input-label for="firstname" :value="__('Prénom')" />
                            <x-text-input wire:model="form.firstname" id="firstname" type="text" name="firstname" required autocomplete="firstname"  placeholder="{{__('Prénom du contact')}}"/>
                            <x-input-error :messages="$errors->get('form.firstname')"/>
                        </div>

                        <!-- lastname -->
                        <div class="form__lastname">
                            <x-input-label for="lastname" :value="__('Nom')" />
                            <x-text-input wire:model="form.lastname" id="lastname" type="text" name="lastname" required autocomplete="lastname"  placeholder="{{__('Nom du contact')}}"/>
                            <x-input-error :messages="$errors->get('form.lastname')"/>
                        </div>

                        <!-- email -->
                        <div class="form__email">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="form.email" id="email" type="email" name="email" required autocomplete="email"  placeholder="{{__('Email du contact')}}"/>
                            <x-input-error :messages="$errors->get('form.email')"/>
                        </div>

                        <!-- button -->
                        <div class="form__buttonContainer">
                            <button type="submit" class="button">{{__('Ajouter le contact')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
