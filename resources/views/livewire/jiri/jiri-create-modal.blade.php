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
            <div class="modal__contentContainer modal__contentContainer--larger">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <div class="form jiriCreateForm">

                            <!-- line -->
                            <hr class="jiriCreateForm__line">

                            <!-- title -->
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Create a Jiri")}}</h2>

                            <!-- infos -->
                            <form wire:submit="update" class="jiriCreateForm__infos">

                                <div class="jiriCreateForm__infos__point"></div>

                                <!-- name -->
                                <div class="form__name">
                                    <x-input-label for="name" :value="__('Title')" />
                                    <x-text-input wire:model.live.debounce.800ms="form.name" id="name" type="text" name="name" required placeholder="{{__('ex: Ending project 2024')}}"/>
                                    <x-input-error :messages="$errors->get('form.name')"/>
                                </div>

                                <!-- start -->
                                <div class="form__date">
                                    <x-input-label for="start" :value="__('Start')" />
                                    <x-text-input wire:model.live.debounce.800ms="form.start" wire:model="form.start" type="datetime-local" name="start" required/>
                                    <x-input-error :messages="$errors->get('form.start')"/>
                                </div>

                                <!-- end -->
                                <div class="form__date">
                                    <x-input-label for="end" :value="__('End')" />
                                    <x-text-input wire:model.live.debounce.800ms="form.end" wire:model="form.end" id="end" type="datetime-local" name="end" required/>
                                    <x-input-error :messages="$errors->get('form.end')"/>
                                </div>

                                <button type="submit" class="button button--fullwidth">{{__('Save this Jiri')}}</button>

                            </form>

                            <!-- projects -->
{{--                            <div class="jiriCreateForm__projects">--}}
{{--                                <div class="jiriCreateForm__projects__point"></div>--}}
{{--                                <div class="jiriCreateForm__projects__listContainer">--}}
{{--                                    <div class="jiriCreateForm__projects__listContainer__top">--}}
{{--                                        <p class="jiriCreateForm__projects__listContainer__top__label">--}}
{{--                                            {{__("Liste des projets")}}--}}
{{--                                        </p>--}}
{{--                                        <livewire:project.project-create-modal/>--}}
{{--                                    </div>--}}
{{--                                    <div class="jiriCreateForm__projects__listContainer__bottom">--}}
{{--                                        <ul class="jiriCreateForm__projects__listContainer__list">--}}
{{--                                            @foreach($this->projects as $project)--}}
{{--                                                <li class="jiriCreateForm__projects__listContainer__list__item">--}}
{{--                                                    <span>{{$project->title}}</span>--}}
{{--                                                    <a wire:click="addProjectToJiri({{$project->id}})">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="jiriCreateForm__projects__selectedContainer">--}}
{{--                                    <p class="jiriCreateForm__projects__selectedContainer__label">--}}
{{--                                        {{__("Liste des projets sélectionnés")}}--}}
{{--                                    </p>--}}
{{--                                    <div class="jiriCreateForm__projects__selectedContainer__bottom">--}}
{{--                                        <ul class="jiriCreateForm__projects__selectedContainer__list">--}}
{{--                                            @foreach($this->selectedProjects as $selectedproject)--}}
{{--                                                <li class="jiriCreateForm__projects__selectedContainer__list__item">--}}
{{--                                                    <span>{{$selectedproject->title}}</span>--}}
{{--                                                    <a wire:click="removeProject({{$selectedproject->id}})">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <!-- contacts -->
{{--                            <div class="jiriCreateForm__contacts">--}}
{{--                                <div class="jiriCreateForm__contacts__point"></div>--}}

{{--                                <div class="jiriCreateForm__contacts__listContainer">--}}
{{--                                    <div class="jiriCreateForm__contacts__listContainer__top">--}}
{{--                                        <p class="jiriCreateForm__contacts__listContainer__top__label">--}}
{{--                                            {{__("Liste des contacts")}}--}}
{{--                                        </p>--}}
{{--                                        <livewire:contact.contact-create-modal/>--}}
{{--                                    </div>--}}
{{--                                    <div class="jiriCreateForm__contacts__listContainer__bottom">--}}
{{--                                        <ul class="jiriCreateForm__contacts__listContainer__list">--}}
{{--                                            @foreach($this->contacts as $contact)--}}
{{--                                                <li class="jiriCreateForm__contacts__listContainer__list__item">--}}
{{--                                                    <span>{{$contact->firstname}}</span>--}}
{{--                                                    <span>{{$contact->lastname}}</span>--}}
{{--                                                    <span>{{$contact->email}}</span>--}}
{{--                                                    <a wire:click="selectContactAsStudent">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                    <a wire:click="selectContactAsJury">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="jiriCreateForm__contacts__selectedContainer">--}}
{{--                                    <div class="jiriCreateForm__contacts__selectedContainer__jury">--}}
{{--                                        <p class="jiriCreateForm__contacts__selectedContainer__jury__label">--}}
{{--                                            {{__("Jury(s) sélectionné(s) ")}}--}}
{{--                                        </p>--}}
{{--                                        <div class="jiriCreateForm__contacts__selectedContainer__jury__listContainer">--}}
{{--                                            <ul class="jiriCreateForm__contacts__selectedContainer__jury__listContainer__list">--}}
{{--                                                <li class="jiriCreateForm__contacts__selectedContainer__jury__listContainer__list__item">--}}
{{--                                                    <span>alall</span>--}}
{{--                                                    <span>alalllzdad</span>--}}
{{--                                                    <span>alalllzdadmle</span>--}}
{{--                                                    <a wire:click="">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                    <a wire:click="">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="jiriCreateForm__contacts__selectedContainer__student">--}}
{{--                                        <p class="jiriCreateForm__contacts__selectedContainer__student__label">--}}
{{--                                            {{__("Étudiant(s) sélectionné(s)")}}--}}
{{--                                        </p>--}}
{{--                                        <div class="jiriCreateForm__contacts__selectedContainer__student__listContainer">--}}
{{--                                            <ul class="jiriCreateForm__contacts__selectedContainer__student__listContainer__list">--}}
{{--                                                <li class="jiriCreateForm__contacts__selectedContainer__student__listContainer__list__item">--}}
{{--                                                    <span>alall</span>--}}
{{--                                                    <span>alalllzdad</span>--}}
{{--                                                    <span>alalllzdadmle</span>--}}
{{--                                                    <a wire:click="">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                    <a wire:click="">--}}
{{--                                                        <svg>--}}
{{--                                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>--}}
{{--                                                        </svg>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <!-- button -->
                            <div class="jiriCreate__contentContainer__formContainer__form__button">
                                <div class="jiriCreate__contentContainer__formContainer__form__button__point"></div>
                                <button type="submit" class="button button--fullwidth">{{__('Save this Jiri')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
