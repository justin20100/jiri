<div>
    @if($projectShowIsOpen == "show")
        <div class="modal" wire:keydown.escape.window="closeProjectShowModal" wire:click.self="closeProjectShowModal">
            <div class="modal__contentContainer modal__contentContainer--showProjectModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeProjectShowModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__showProject projectShow">
                        <div class="projectShow__title">
                            <p class="projectShow__title__label">{{__("Title")}}</p>
                            <p class="projectShow__title__text">{{$project->title}}</p>
                        </div>
                        <div class="projectShow__description">
                            <p class="projectShow__description__label">{{__("Description")}}</p>
                            <p class="projectShow__description__text">{{$project->description}}</p>
                        </div>
                        <div class="projectShow__actions">
                            <button wire:click="openProjectUpdateModal({{$project->id}})" class="projectShow__actions__edit button">
                                Edit
                            </button>
                            <button wire:click="deleteProject({{$project->id}})" class="projectShow__actions__delete button button--red">
                                delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($projectShowIsOpen == "update")
        <div class="modal" wire:keydown.escape.window="openProjectShowModal({{$project->id}})" wire:click.self="openProjectShowModal({{$project->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateProjectModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openProjectShowModal({{$project->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="updateProject" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit project")}}</h2>

                            <div class="form__title">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input wire:model="projectForm.title" id="title" type="text" name="title" required autocomplete="title"  placeholder="{{__('ex: Ending project')}}"/>
                                <x-input-error :messages="$errors->get('projectForm.title')"/>
                            </div>

                            <div class="form__description">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea wire:model="projectForm.description" id="description" type="text" name="description" required autocomplete="description" rows="3" placeholder="{{__('What is this project about ...')}}"></textarea>
                                <x-input-error :messages="$errors->get('projectForm.description')"/>
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
