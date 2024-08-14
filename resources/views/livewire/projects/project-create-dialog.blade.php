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
                            {{__('Successfully added :')}}
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

    <a wire:click="openDialog" class="button">{{__('Ajouter un projet')}}</a>
    @if($isOpen)
        <div class="dialog">
            <div class="dialog__contentContainer">
                <a wire:click="closeDialog" class="dialog__contentContainer__closeContainer">
                    <svg class="dialog__contentContainer__closeContainer__svg">
                        <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                    </svg>
                </a>
                <div class="dialog__contentContainer__formContainer">
                    <form wire:submit="create" class="form dialog__contentContainer__formContainer__form">
                        <h2 class="dialog__contentContainer__formContainer__form__title">{{__("Ajout d'un projet")}}</h2>

                        <div class="form__title">
                            <x-input-label for="title" :value="__('Titre')" />
                            <x-text-input wire:model="form.title" id="title" type="text" name="title" required autocomplete="title"  placeholder="{{__('Titre du projet')}}"/>
                            <x-input-error :messages="$errors->get('form.title')"/>
                        </div>

                        <div class="form__description">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea wire:model="form.description" id="description" type="text" name="description" required autocomplete="description" rows="3" placeholder="{{__('Description du projet')}}"></textarea>
                            <x-input-error :messages="$errors->get('form.description')"/>
                        </div>

                        <div class="form__buttonContainer">
                            <button type="submit" class="button">{{__('Ajouter le projet')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
