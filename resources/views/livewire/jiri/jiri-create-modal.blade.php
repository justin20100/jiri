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

    <a wire:click="openModal" class="button">{{__('Create a Jiri')}}</a>

    @if($isOpen)
        <div class="modal" wire:keydown.escape.window="closeModal" wire:click.self="closeModal">
            <div class="modal__contentContainer modal__contentContainer--createJiriModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <div class="form jiriCreateForm">

                            <!-- steps -->
                            <div class="jiriCreateForm__stepsContainer">
                                <hr class="jiriCreateForm__stepsContainer__line">
                                <div class="jiriCreateForm__stepsContainer__pointsContainer">
                                    <div wire:click="showInfosStep" class="jiriCreateForm__stepsContainer__pointsContainer__point @if($this->step == "infos")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif"></div>
                                    <div wire:click="showProjectsStep" class="jiriCreateForm__stepsContainer__pointsContainer__point @if($this->step == "projects")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif"></div>
                                    <div wire:click="showContactsStep" class="jiriCreateForm__stepsContainer__pointsContainer__point @if($this->step == "contacts")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif"></div>
                                    <div class="jiriCreateForm__stepsContainer__pointsContainer__point @if($this->step == "summary")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif"></div>
                                </div>
                            </div>`

                            <!-- title -->
                            <div class="jiriCreateForm__textContainer">
                                <h2 class="modal__contentContainer__content__formContainer__form__title jiriCreateForm__textContainer__title">{{__("Create a Jiri")}}</h2>

                                <p class="jiriCreateForm__textContainer__text">
                                    @if($this->step == "infos")
                                        {{__("Lets start your Jiri creation by choosing a title, a start and an end date.")}}
                                        @elseif($this->step == "projects")
                                        {{__("Now, select the projects you want to include in this Jiri. You can also create new projects ")}}
                                        @elseif($this->step == "contacts")
                                        {{__("Finally, select the contacts you want to include in this Jiri.")}}
                                        @elseif($this->step == "summary")
                                        {{__("Here is a summary of your Jiri.")}}
                                    @endif
                                </p>
                            </div>

                            <!-- infos -->
                            @if($this->step == "infos")
                                <form wire:submit="updateJiriInfos" class="jiriCreateForm__infos">

                                    <!-- name -->
                                    <div class="form__name jiriCreateForm__infos__name">
                                        <x-input-label for="name" :value="__('Title')" />
                                        <x-text-input wire:model="jiriInfosForm.name" id="name" type="text" name="name" required placeholder="{{__('ex: Ending project 2024')}}"/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.name')"/>
                                    </div>

                                    <!-- start -->
                                    <div class="form__date jiriCreateForm__infos__start">
                                        <x-input-label for="start" :value="__('Start')" />
                                        <x-text-input wire:model="jiriInfosForm.start" type="datetime-local" name="start" required/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.start')"/>
                                    </div>

                                    <!-- end -->
                                    <div class="form__date jiriCreateForm__infos__end">
                                        <x-input-label for="end" :value="__('End')" />
                                        <x-text-input wire:model="jiriInfosForm.end" id="end" type="datetime-local" name="end" required/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.end')"/>
                                    </div>

                                    <button type="submit" class="button jiriCreateForm__infos__button">{{__('Next step')}}</button>

                                </form>
                            @endif

                            <!-- projects -->
                            @if($this->step == "projects")
                                <form wire:submit="updateLinkedProjectsToAJiri" class="jiriCreateForm__projects">
                                    <div class="jiriCreateForm__projects__listContainer">
                                        <div class="jiriCreateForm__projects__listContainer__top">
                                            <p class="jiriCreateForm__projects__listContainer__top__label">
                                                {{__("Your projects")}}
                                            </p>
                                            <livewire:project.project-create-modal/>
                                        </div>
                                        <div class="jiriCreateForm__projects__listContainer__bottom">
                                            <ul class="jiriCreateForm__projects__listContainer__list">
                                                @foreach($this->projects as $project)
                                                    <li class="jiriCreateForm__projects__listContainer__list__item">
                                                        <span>{{$project->title}}</span>
                                                        <a wire:click="addProjectToSelectedProjects({{$project->id}})" title="{{__("Add to selected projects list")}}">
                                                            <p>{{__("Add to selected")}}</p>
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#arrowright")}}"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jiriCreateForm__projects__selectedContainer">
                                        <p class="jiriCreateForm__projects__selectedContainer__label">
                                            {{__("Selected project(s) for this Jiri")}}
                                        </p>
                                        <x-input-error :messages="$errors->get('jiriProjectForm.selectedProjects')"/>
                                        <div class="jiriCreateForm__projects__selectedContainer__bottom">
                                            <ul class="jiriCreateForm__projects__selectedContainer__list">
                                                @foreach($this->jiriProjectForm->selectedProjects as $selectedproject)
                                                    <li class="jiriCreateForm__projects__selectedContainer__list__item">
                                                        <span>{{$selectedproject->title}}</span>
                                                        <a wire:click="removeProjectFromSelectedProjects({{$selectedproject->id}})" title="{{__("Delete from selected projects list")}}">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                            </svg>
                                                            <p>
                                                                {{__("Move from selected")}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="submit" class="button jiriCreateForm__projects__button">{{__('Next step')}}</button>
                                </form>
                            @endif
                            <!-- contacts -->
                            @if($this->step == "contacts")
                                <div class="jiriCreateForm__contacts">
                                    <div class="jiriCreateForm__contacts__point"></div>

                                    <div class="jiriCreateForm__contacts__listContainer">
                                        <div class="jiriCreateForm__contacts__listContainer__top">
                                            <p class="jiriCreateForm__contacts__listContainer__top__label">
                                                {{__("Liste des contacts")}}
                                            </p>
                                            <livewire:contact.contact-create-modal/>
                                        </div>
                                        <div class="jiriCreateForm__contacts__listContainer__bottom">
                                            <ul class="jiriCreateForm__contacts__listContainer__list">
                                                @foreach($this->contacts as $contact)
                                                    <li class="jiriCreateForm__contacts__listContainer__list__item">
                                                        <span>{{$contact->firstname}}</span>
                                                        <span>{{$contact->lastname}}</span>
                                                        <span>{{$contact->email}}</span>
                                                        <a wire:click="selectContactAsStudent">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>
                                                            </svg>
                                                        </a>
                                                        <a wire:click="selectContactAsJury">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="jiriCreateForm__contacts__selectedContainer">
                                        <div class="jiriCreateForm__contacts__selectedContainer__jury">
                                            <p class="jiriCreateForm__contacts__selectedContainer__jury__label">
                                                {{__("Jury(s) sélectionné(s) ")}}
                                            </p>
                                            <div class="jiriCreateForm__contacts__selectedContainer__jury__listContainer">
                                                <ul class="jiriCreateForm__contacts__selectedContainer__jury__listContainer__list">
                                                    <li class="jiriCreateForm__contacts__selectedContainer__jury__listContainer__list__item">
                                                        <span>alall</span>
                                                        <span>alalllzdad</span>
                                                        <span>alalllzdadmle</span>
                                                        <a wire:click="">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                            </svg>
                                                        </a>
                                                        <a wire:click="">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="jiriCreateForm__contacts__selectedContainer__student">
                                            <p class="jiriCreateForm__contacts__selectedContainer__student__label">
                                                {{__("Étudiant(s) sélectionné(s)")}}
                                            </p>
                                            <div class="jiriCreateForm__contacts__selectedContainer__student__listContainer">
                                                <ul class="jiriCreateForm__contacts__selectedContainer__student__listContainer__list">
                                                    <li class="jiriCreateForm__contacts__selectedContainer__student__listContainer__list__item">
                                                        <span>alall</span>
                                                        <span>alalllzdad</span>
                                                        <span>alalllzdadmle</span>
                                                        <a wire:click="">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                            </svg>
                                                        </a>
                                                        <a wire:click="">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- summary -->
                            @if($this->step == "summary")

                                <!-- button -->
                                <div class="jiriCreate__contentContainer__formContainer__form__button">
                                    <div class="jiriCreate__contentContainer__formContainer__form__button__point"></div>
                                    <button type="submit" class="button button--fullwidth">{{__('Save this Jiri')}}</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
