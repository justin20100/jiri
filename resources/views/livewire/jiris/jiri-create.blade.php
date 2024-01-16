<div class="jiriCreate">
    <div class="jiriCreate__contentContainer">
        <div class="wrapper">
            <h1 class="jiriCreate__contentContainer__title">{{__("Ajout d'un jiri")}}</h1>
            <p class="jiriCreate__contentContainer__text">{{__("Texte descriptif sur le jiris")}}</p>
            <div class="jiriCreate__contentContainer__formContainer">
                <hr class="jiriCreate__contentContainer__formContainer__line">
                <form wire:submit="create" class="form jiriCreate__contentContainer__formContainer__form">

                    <!-- infos -->
                    <div class="jiriCreate__contentContainer__formContainer__form__infos">
                        <div class="jiriCreate__contentContainer__formContainer__form__infos__point"></div>
                        <!-- name -->
                        <div class="form__name">
                            <x-input-label for="name" :value="__('Titre')" />
                            <x-text-input wire:model="form.name" id="name" type="text" name="name" required placeholder="{{__('Le titre de votre Jiri')}}"/>
                            <x-input-error :messages="$errors->get('form.name')"/>
                        </div>

                        <!-- start -->
                        <div class="form__date">
                            <x-input-label for="start" :value="__('Début')" />
                            <x-text-input wire:model="form.start" id="start" type="datetime-local" name="start" required/>
                            <x-input-error :messages="$errors->get('form.start')"/>
                        </div>

                        <!-- end -->
                        <div class="form__date">
                            <x-input-label for="end" :value="__('Fin')" />
                            <x-text-input wire:model="form.end" id="end" type="datetime-local" name="end" required/>
                            <x-input-error :messages="$errors->get('form.end')"/>
                        </div>
                    </div>

                    <!-- infos -->
                    <div class="jiriCreate__contentContainer__formContainer__form__projects">
                        <div class="jiriCreate__contentContainer__formContainer__form__projects__point"></div>
                        <div class="jiriCreate__contentContainer__formContainer__form__projects__listContainer">
                            <div class="jiriCreate__contentContainer__formContainer__form__projects__listContainer__top">
                                <p class="jiriCreate__contentContainer__formContainer__form__projects__listContainer__top__label">
                                    {{__("Liste des projets")}}
                                </p>
                                <livewire:projects.project-create-dialog/>
                            </div>
                            <div class="jiriCreate__contentContainer__formContainer__form__projects__listContainer__bottom">
                                <ul class="jiriCreate__contentContainer__formContainer__form__projects__listContainer__list">
                                    @foreach($this->projects as $project)
                                        <li class="jiriCreate__contentContainer__formContainer__form__projects__listContainer__list__item">
                                            <span>{{$project->title}}</span>
                                            <a wire:click.prefetch="selectProject({{$project->id}})">
                                                <svg>
                                                    <use xlink:href="{{asset("images/sprite.svg#plus")}}"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="jiriCreate__contentContainer__formContainer__form__projects__selectedContainer">
                            <p class="jiriCreate__contentContainer__formContainer__form__projects__selectedContainer__label">
                                {{__("Liste des projets sélectionnés")}}
                            </p>
                            <div class="jiriCreate__contentContainer__formContainer__form__projects__selectedContainer__bottom">
                                <ul class="jiriCreate__contentContainer__formContainer__form__projects__selectedContainer__list">
                                    @foreach($this->selectedProjects as $selectedproject)
                                        <li class="jiriCreate__contentContainer__formContainer__form__projects__selectedContainer__list__item">
                                            <span>{{$selectedproject->title}}</span>
                                            <a wire:click="removeProject({{$selectedproject->id}})">
                                                <svg>
                                                    <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- contacts -->
                    <div class="jiriCreate__contentContainer__formContainer__form__contacts">
                        <div class="jiriCreate__contentContainer__formContainer__form__contacts__point"></div>

                        <div class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer">
                            <div class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer__top">
                                <p class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer__top__label">
                                    {{__("Liste des contacts")}}
                                </p>
                                <livewire:contacts.contact-create-dialog/>
                            </div>
                            <div class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer__bottom">
                                <ul class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer__list">
                                    @foreach($this->contacts as $contact)
                                        <li class="jiriCreate__contentContainer__formContainer__form__contacts__listContainer__list__item">
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

                        <div class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer">
                            <div class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__jury">
                                <p class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__jury__label">
                                    {{__("Jury(s) sélectionné(s) ")}}
                                </p>
                                <div class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__jury__listContainer">
                                    <ul class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__jury__listContainer__list">
                                        <li class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__jury__listContainer__list__item">
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

                            <div class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__student">
                                <p class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__student__label">
                                    {{__("Étudiant(s) sélectionné(s)")}}
                                </p>
                                <div class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__student__listContainer">
                                    <ul class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__student__listContainer__list">
                                        <li class="jiriCreate__contentContainer__formContainer__form__contacts__selectedContainer__student__listContainer__list__item">
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

                    <!-- button -->
                    <div class="jiriCreate__contentContainer__formContainer__form__button">
                        <div class="jiriCreate__contentContainer__formContainer__form__button__point"></div>
                        <button type="submit" class="button button--fullwidth">{{__('Ajouter le Jiri')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
