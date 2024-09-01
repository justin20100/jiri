<div>
    <a wire:click="openProjectCreateModal" class="button">{{__('Create a project')}}</a>
    @if($projectCreateIsOpen)
        <div class="modal" wire:keydown.escape.window="closeProjectCreateModal" wire:click.self="closeProjectCreateModal">
            <div class="modal__contentContainer modal__contentContainer--createProjectModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeProjectCreateModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="create" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Create a project")}}</h2>

                            <div class="form__title">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input wire:model="form.title" id="title" type="text" name="title" required autocomplete="title"  placeholder="{{__('ex: Ending project')}}"/>
                                <x-input-error :messages="$errors->get('form.title')"/>
                            </div>

                            <div class="form__description">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea wire:model="form.description" id="description" type="text" name="description" required autocomplete="description" rows="3" placeholder="{{__('What is this project about ...')}}"></textarea>
                                <x-input-error :messages="$errors->get('form.description')"/>
                            </div>

                            <div class="form__buttonContainer">
                                <button type="submit" class="button">{{__('Save this projet')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
