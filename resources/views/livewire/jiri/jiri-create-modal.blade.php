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

                            <!-- title -->
                            <div class="jiriCreateForm__textContainer">
                                <h2 class="jiriCreateForm__textContainer__title">{{__("Create a Jiri")}}</h2>

                                <p class="jiriCreateForm__textContainer__text">
                                    @if($this->step == "infos")
                                        {{__("Lets start your Jiri creation by choosing a name, a start and an end date.")}}
                                    @elseif($this->step == "project")
                                        {{__("Now, select the projects you want to include in this Jiri. You can also create new projects ")}}
                                    @elseif($this->step == "contact")
                                        {{__("Finally, select contacts as evaluator or student that you want to include in this Jiri.")}}
                                    @elseif($this->step == "summary")
                                        {{__("Here is a summary of your Jiri.")}}
                                    @endif
                                </p>
                            </div>

                            <!-- steps -->
                            <div class="jiriCreateForm__stepsContainer">
                                <hr class="jiriCreateForm__stepsContainer__line">
                                <div class="jiriCreateForm__stepsContainer__pointsContainer">
                                    <div @if($this->successJiriInfos) wire:click="showStep('infos')" @endif
                                         class="jiriCreateForm__stepsContainer__pointsContainer__point
                                         @if($this->successJiriInfos) jiriCreateForm__stepsContainer__pointsContainer__point--validated @endif
                                         @if($this->step == "infos")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif
                                         ">
                                    </div>
                                    <div @if($this->successJiriProject || $this->successJiriInfos) wire:click="showStep('project')" @endif
                                         class="jiriCreateForm__stepsContainer__pointsContainer__point
                                         @if($this->successJiriProject)jiriCreateForm__stepsContainer__pointsContainer__point--validated @endif
                                         @if($this->step == "project")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif
                                         ">
                                    </div>
                                    <div @if($this->successJiriEvaluator || $this->successJiriProject) wire:click="showStep('evaluator')" @endif
                                         class="jiriCreateForm__stepsContainer__pointsContainer__point
                                         @if($this->successJiriEvaluator)jiriCreateForm__stepsContainer__pointsContainer__point--validated @endif
                                         @if($this->step == "evaluator")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif
                                         ">
                                    </div>
                                    <div @if($this->successJiriStudent || $this->successJiriEvaluator) wire:click="showStep('student')" @endif
                                         class="jiriCreateForm__stepsContainer__pointsContainer__point
                                         @if($this->successJiriStudent)jiriCreateForm__stepsContainer__pointsContainer__point--validated @endif
                                         @if($this->step == "student")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif
                                         ">
                                    </div>
                                    <div @if($this->successJiriStudent) wire:click="showStep('summary')" @endif
                                        class="jiriCreateForm__stepsContainer__pointsContainer__point
                                        @if($this->step == "summary")jiriCreateForm__stepsContainer__pointsContainer__point--focus @endif
                                        ">
                                    </div>
                                </div>
                            </div>

                            <!-- infos -->
                            @if($this->step == "infos")
                                <form wire:submit="showStep('project')" class="jiriCreateForm__infos">

                                    <!-- name -->
                                    <div class="form__name jiriCreateForm__infos__name">
                                        <x-input-label for="name" :value="__('Choose a name for your Jiri')" />
                                        <x-text-input wire:model="jiriInfosForm.name" id="name" type="text" name="name" required placeholder="{{__('ex: Ending project 2024')}}"/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.name')"/>
                                    </div>

                                    <!-- start -->
                                    <div class="form__date jiriCreateForm__infos__start">
                                        <x-input-label for="start" :value="__('Start date')" />
                                        <x-text-input wire:model="jiriInfosForm.start" type="datetime-local" name="start" required/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.start')"/>
                                    </div>

                                    <!-- end -->
                                    <div class="form__date jiriCreateForm__infos__end">
                                        <x-input-label for="end" :value="__('End date')" />
                                        <x-text-input wire:model="jiriInfosForm.end" id="end" type="datetime-local" name="end" required/>
                                        <x-input-error :messages="$errors->get('jiriInfosForm.end')"/>
                                    </div>

                                    <button type="submit" class="button jiriCreateForm__infos__button">{{__('Next step')}}</button>

                                </form>
                            @endif

                            <!-- projects -->
                            @if($this->step == "project")
                                <form wire:submit="showStep('evaluator')" class="jiriCreateForm__projects">
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
                                                        <a wire:click="removeProjectFromSelectedProjects({{$selectedproject->id}})" title="{{__("Remove from selected projects list")}}">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#arrowleft")}}"></use>
                                                            </svg>
                                                            <p>
                                                                {{__("Remove from selected")}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button wire:click.prevent="showStep('infos')" class="button jiriCreateForm__projects__previous">{{__("Previous step")}}</button>
                                    <button type="submit" class="button jiriCreateForm__projects__button">{{__('Next step')}}</button>
                                </form>
                            @endif

                            <!-- evaluator -->
                            @if($this->step == "evaluator")
                                <form wire:submit="showStep('student')" class="jiriCreateForm__contacts">
                                    <div class="jiriCreateForm__contacts__listContainer">
                                        <div class="jiriCreateForm__contacts__listContainer__top">
                                            <p class="jiriCreateForm__contacts__listContainer__top__label">
                                                {{__("Your contacts")}}
                                            </p>
                                            <livewire:contact.contact-create-modal/>
                                        </div>
                                        <div class="jiriCreateForm__contacts__listContainer__bottom">
                                            <ul class="jiriCreateForm__contacts__listContainer__list">
                                                @foreach($this->contacts as $contact)
                                                    <li class="jiriCreateForm__contacts__listContainer__list__item">
                                                        <span>{{$contact->firstname." ".$contact->lastname}}</span>
                                                        <a wire:click="addContactToSelectedEvaluator({{$contact->id}})" title="{{__("Add to selected evaluators list")}}">
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
                                    <div class="jiriCreateForm__contacts__selectedContainer">
                                        <p class="jiriCreateForm__contacts__selectedContainer__label">
                                            {{__("Selected evaluators(s) for this Jiri")}}
                                        </p>
                                        <x-input-error :messages="$errors->get('jiriEvaluatorForm.selectedEvaluator')"/>
                                        <div class="jiriCreateForm__contacts__selectedContainer__bottom">
                                            <ul class="jiriCreateForm__contacts__selectedContainer__list">
                                                @foreach($this->jiriEvaluatorForm->selectedEvaluator as $evaluator)
                                                    <li class="jiriCreateForm__contacts__selectedContainer__list__item">
                                                        <span>{{$evaluator->firstname." ".$evaluator->lastname}}</span>
                                                        <a wire:click="removeContactFromSelectedEvaluator({{$evaluator->id}})" title="{{__("Remove from selected evaluators list")}}">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#arrowleft")}}"></use>
                                                            </svg>
                                                            <p>
                                                                {{__("Remove from selected")}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button wire:click.prevent="showStep('projects')" class="button jiriCreateForm__contacts__previous">{{__("Previous step")}}</button>
                                    <button type="submit" class="button jiriCreateForm__contacts__button">{{__('Next step')}}</button>
                                </form>
                            @endif

                            <!-- student -->
                            @if($this->step == "student")
                                <form wire:submit="showStep('summary')" class="jiriCreateForm__contacts">
                                    <div class="jiriCreateForm__contacts__listContainer">
                                        <div class="jiriCreateForm__contacts__listContainer__top">
                                            <p class="jiriCreateForm__contacts__listContainer__top__label">
                                                {{__("Your contacts without the selected evaluators")}}
                                            </p>
                                            <livewire:contact.contact-create-modal/>
                                        </div>
                                        <div class="jiriCreateForm__contacts__listContainer__bottom">
                                            <ul class="jiriCreateForm__contacts__listContainer__list">
                                                @foreach($this->contacts as $contact)
                                                    <li class="jiriCreateForm__contacts__listContainer__list__item">
                                                        <span>{{$contact->firstname." ".$contact->lastname}}</span>
                                                        <a wire:click="addContactToSelectedStudent({{$contact->id}})" title="{{__("Add to selected student list")}}">
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
                                    <div class="jiriCreateForm__contacts__selectedContainer">
                                        <p class="jiriCreateForm__contacts__selectedContainer__label">
                                            {{__("Selected students(s) for this Jiri")}}
                                        </p>
                                        <x-input-error :messages="$errors->get('jiriStudentForm.selectedStudent')"/>
                                        <div class="jiriCreateForm__contacts__selectedContainer__bottom">
                                            <ul class="jiriCreateForm__contacts__selectedContainer__list">
                                                @foreach($this->jiriStudentForm->selectedStudent as $student)
                                                    <li class="jiriCreateForm__contacts__selectedContainer__list__item">
                                                        <span>{{$student->firstname." ".$student->lastname}}</span>
                                                        <a wire:click="removeContactFromSelectedStudent({{$student->id}})" title="{{__("Remove from selected students list")}}">
                                                            <svg>
                                                                <use xlink:href="{{asset("images/sprite.svg#arrowleft")}}"></use>
                                                            </svg>
                                                            <p>
                                                                {{__("Remove from selected")}}
                                                            </p>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <button wire:click.prevent="showStep('evaluator')" class="button jiriCreateForm__contacts__previous">{{__("Previous step")}}</button>
                                    <button type="submit" class="button jiriCreateForm__contacts__button">{{__('Last step')}}</button>
                                </form>
                            @endif

                            <!-- summary -->
                            @if($this->step == "summary")
                                <div class="jiriCreateForm__summary">

                                    <!-- infos -->
                                    <div class="jiriCreateForm__summary__infos">
                                        <p class="jiriCreateForm__summary__infos__text jiriCreateForm__summary__infos__text--name">
                                            <span class="jiriCreateForm__summary__infos__text__label">
                                                {{__("Jiri name")}}
                                            </span>
                                            <span class="jiriCreateForm__summary__infos__text__data">
                                                {{$this->jiri->name}}
                                            </span>
                                        </p>
                                        <p class="jiriCreateForm__summary__infos__text jiriCreateForm__summary__infos__text--start">
                                            <span class="jiriCreateForm__summary__infos__text__label">
                                                {{__("Start date")}}
                                            </span>
                                            <span class="jiriCreateForm__summary__infos__text__data">
                                                {{\Carbon\Carbon::parse($this->jiri->start)->format('d/m/Y H:i')}}
                                            </span>
                                        </p>
                                        <p class="jiriCreateForm__summary__infos__text jiriCreateForm__summary__infos__text--end">
                                            <span class="jiriCreateForm__summary__infos__text__label">
                                                {{__("End date")}}
                                            </span>
                                            <span class="jiriCreateForm__summary__infos__text__data">
                                                {{\Carbon\Carbon::parse($this->jiri->end)->format('d/m/Y H:i')}}
                                            </span>
                                        </p>
                                    </div>

                                    <!-- project -->
                                    <div class="jiriCreateForm__summary__project">
                                        <p class="jiriCreateForm__summary__project__title">
                                            {{count($this->jiriProjectForm->selectedProjects)}}
                                            {{count($this->jiriProjectForm->selectedProjects) > 1 ?__(" projects selected"):__(" project selected")}}
                                        </p>
                                        <ul class="jiriCreateForm__summary__project__list">
                                            @foreach($this->jiriProjectForm->selectedProjects as $project)
                                                <li class="jiriCreateForm__summary__project__list__item">
                                                    <p class="jiriCreateForm__summary__project__list__item__title">
                                                        {{$project->title}}
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- student -->
                                    <div class="jiriCreateForm__summary__student">
                                        <p class="jiriCreateForm__summary__student__title" >
                                            {{count($this->jiriStudentForm->selectedStudent)}}
                                            {{count($this->jiriStudentForm->selectedStudent) > 1 ?__(" students selected"):__(" student selected")}}
                                        </p>
                                        <ul class="jiriCreateForm__summary__student__list">
                                            @foreach($this->jiriStudentForm->selectedStudent as $student)
                                                <li class="jiriCreateForm__summary__student__list__item">
                                                    <div class="jiriCreateForm__summary__student__list__item__avatar">
                                                        <img src="{{URL::to('/storage/avatars')."/".$student->avatar}}" alt="avatar">
                                                    </div>
                                                    <p class="jiriCreateForm__summary__student__list__item__name">
                                                        {{$student->firstname." ".$student->lastname}}
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- evaluator -->
                                    <div class="jiriCreateForm__summary__evaluator">
                                        <p class="jiriCreateForm__summary__evaluator__title">
                                            {{count($this->jiriEvaluatorForm->selectedEvaluator)}}
                                            {{count($this->jiriEvaluatorForm->selectedEvaluator) > 1 ?__(" evaluators selected"):__(" evaluator selected")}}
                                        </p>
                                        <ul class="jiriCreateForm__summary__evaluator__list">
                                            @foreach($this->jiriEvaluatorForm->selectedEvaluator as $evaluator)
                                                <li class="jiriCreateForm__summary__evaluator__list__item">
                                                    <div class="jiriCreateForm__summary__evaluator__list__item__avatar">
                                                        <img src="{{URL::to('/storage/avatars')."/".$evaluator->avatar}}" alt="avatar">
                                                    </div>
                                                    <p class="jiriCreateForm__summary__evaluator__list__item__name">
                                                        {{$evaluator->firstname." ".$evaluator->lastname}}
                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!-- button -->
                                    <div class="jiriCreateForm__summary__button">
                                        <button wire:click.prevent="closeModal()" class="button button--fullwidth">{{__('Save this Jiri')}}</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
