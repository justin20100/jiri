<div>
    @if($contactShowIsOpen == "show")
        <div class="modal" wire:keydown.escape.window="closeContactShowModal" wire:click.self="closeContactShowModal">
            <div class="modal__contentContainer modal__contentContainer--showContactModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeContactShowModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__showProject contactShow">

                        <div class="contactShow__avatar">
                            <div class="contactShow__avatar__preview">
                                <img src="{{URL::to('/storage/avatars')."/".$contact->avatar}}" alt="avatar" class="contactShow__avatar__preview__img">
                            </div>
                        </div>

                        <div class="contactShow__name">
                            <p class="contactShow__name__firstname">{{$contact->firstname}}</p>
                            <p class="contactShow__name__lastname">{{$contact->lastname}}</p>
                        </div>

                        <div class="contactShow__email">
                            <p class="contactShow__email__text">{{$contact->email}}</p>
                        </div>

                        <div class="contactShow__actions">
                            <button wire:click="openContactUpdateModal({{$contact->id}})" class="contactShow__actions__edit button">
                                Edit
                            </button>
                            <button wire:click="deleteContact({{$contact->id}})" class="contactShow__actions__delete button button--red">
                                delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($contactShowIsOpen == "update")
        <div class="modal" wire:keydown.escape.window="openContactShowModal({{$contact->id}})" wire:click.self="openContactShowModal({{$contact->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateContactModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openContactShowModal({{$contact->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="updateContact" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit contact")}}</h2>

                            <!-- Avatar -->
                            <div class="form__avatar">
                                <div class="form__avatar__preview">
                                    @if ($this->savedAvatar === $contactForm->avatar)
                                        <img src="{{ URL::to('/storage/avatars/'.$contactForm->avatar) }}" class="form__avatar__preview__img" alt="avatar">
                                    @else
                                        <img src="{{ $contactForm->avatar->temporaryUrl() }}" class="form__avatar__preview__img" alt="avatar">
                                    @endif
                                </div>

                                <label class="form__avatar__label" for="form__avatar__label__iconWrapper__input">
                                    <div class="form__avatar__label__iconWrapper">
                                        <input type="file" wire:model="contactForm.avatar" id="form__avatar__label__iconWrapper__input"/>
                                        <svg class="form__avatar__label__iconWrapper__icon">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </div>
                                </label>

                                <x-input-error :messages="$errors->get('contactForm.avatar')"/>
                            </div>

                            <!-- Firstname -->
                            <div class="form__firstname">
                                <x-input-label for="firstname" :value="__('Firstname')" />
                                <x-text-input wire:model="contactForm.firstname" id="firstname" type="text" name="firstname" required autocomplete="firstname"  placeholder="{{__('ex: Léo')}}"/>
                                <x-input-error :messages="$errors->get('contactForm.firstname')"/>
                            </div>

                            <!-- lastname -->
                            <div class="form__lastname">
                                <x-input-label for="lastname" :value="__('Lastname')" />
                                <x-text-input wire:model="contactForm.lastname" id="lastname" type="text" name="lastname" required autocomplete="lastname"  placeholder="{{__('ex: Dubois')}}"/>
                                <x-input-error :messages="$errors->get('contactForm.lastname')"/>
                            </div>

                            <!-- email -->
                            <div class="form__email">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input wire:model="contactForm.email" id="email" type="email" name="email" required autocomplete="email"  placeholder="{{__('ex: leodubois@gmail.com')}}"/>
                                <x-input-error :messages="$errors->get('contactForm.email')"/>
                            </div>

                            <div class="form__buttonContainer">
                                <button type="submit" class="button">{{__('Save this changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
