<div>
    @if($jiriShowIsOpen == "show")
        <div class="modal" wire:keydown.escape.window="closeJiriShowModal" wire:click.self="closeJiriShowModal">
            <div class="modal__contentContainer modal__contentContainer--showJiriModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="closeJiriShowModal" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__showProject jiriShow">

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
                            <button wire:click.prevent="openJiriUpdateInfosModal" class="jiriShow__editButton button">
                                <svg class="jiriShow__editButton__svg">
                                    <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                </svg>
                            </button>
                        </div>

                        <!-- project -->
                        <div class="jiriCreateForm__summary__project">
                            <p class="jiriCreateForm__summary__project__title">
                                {{count($this->projects)}}
                                {{count($this->projects) > 1 ?__(" projects selected"):__(" project selected")}}
                            </p>
                            <ul class="jiriCreateForm__summary__project__list">
                                @foreach($this->projects as $project)
                                    <li class="jiriCreateForm__summary__project__list__item">
                                        <p class="jiriCreateForm__summary__project__list__item__title">
                                            {{$project->title}}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                            <button class="jiriShow__editButton button">
                                <svg class="jiriShow__editButton__svg">
                                    <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                </svg>
                            </button>
                        </div>

                        <!-- student -->
                        <div class="jiriCreateForm__summary__student">
                            <p class="jiriCreateForm__summary__student__title" >
                                {{count($this->students)}}
                                {{count($this->students) > 1 ?__(" students selected"):__(" student selected")}}
                            </p>
                            <ul class="jiriCreateForm__summary__student__list">
                                @foreach($this->students as $student)
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
                            <button class="jiriShow__editButton button">
                                <svg class="jiriShow__editButton__svg">
                                    <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                </svg>
                            </button>
                        </div>

                        <!-- evaluator -->
                        <div class="jiriCreateForm__summary__evaluator">
                            <p class="jiriCreateForm__summary__evaluator__title">
                                {{count($this->evaluators)}}
                                {{count($this->evaluators) > 1 ?__(" evaluators selected"):__(" evaluator selected")}}
                            </p>
                            <ul class="jiriCreateForm__summary__evaluator__list">
                                @foreach($this->evaluators as $evaluator)
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
                            <button class="jiriShow__editButton button">
                                <svg class="jiriShow__editButton__svg">
                                    <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($jiriShowIsOpen == "updateInfos")
        <div class="modal" wire:keydown.escape.window="openJiriShowModal({{$jiri->id}})" wire:click.self="openJiriShowModal({{$jiri->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateJiriModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openJiriShowModal({{$jiri->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                                <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit jiri infos")}}</h2>
                            <form wire:submit="updateJiriInfos" class="jiriCreateForm__infos">

                                <!-- name -->
                                <div class="form__name jiriCreateForm__infos__name">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input wire:model="jiriInfosForm.name" id="name" type="text" name="name" placeholder="{{__('ex: Ending project 2024')}}"/>
                                    <x-input-error :messages="$errors->get('jiriInfosForm.name')"/>
                                </div>

                                <!-- start -->
                                <div class="form__date jiriCreateForm__infos__start">
                                    <x-input-label for="start" :value="__('Start date')" />
                                    <x-text-input wire:model="jiriInfosForm.start" type="datetime-local" name="start"/>
                                    <x-input-error :messages="$errors->get('jiriInfosForm.start')"/>
                                </div>

                                <!-- end -->
                                <div class="form__date jiriCreateForm__infos__end">
                                    <x-input-label for="end" :value="__('End date')" />
                                    <x-text-input wire:model="jiriInfosForm.end" id="end" type="datetime-local" name="end"/>
                                    <x-input-error :messages="$errors->get('jiriInfosForm.end')"/>
                                </div>
                                <button type="submit" class="button jiriCreateForm__infos__button">{{__('Save this changes')}}</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($jiriShowIsOpen == "updateProject")
        <div class="modal" wire:keydown.escape.window="openContactShowModal({{$jiri->id}})" wire:click.self="openContactShowModal({{$jiri->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateContactModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openContactShowModal({{$jiri->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="updateContact" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit jiri project")}}</h2>


                            <div class="form__buttonContainer">
                                <button type="submit" class="button">{{__('Save this changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($jiriShowIsOpen == "updateEvaluator")
        <div class="modal" wire:keydown.escape.window="openContactShowModal({{$jiri->id}})" wire:click.self="openContactShowModal({{$jiri->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateContactModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openContactShowModal({{$jiri->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="updateContact" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit jiri project")}}</h2>


                            <div class="form__buttonContainer">
                                <button type="submit" class="button">{{__('Save this changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif($jiriShowIsOpen == "updateStudent")
        <div class="modal" wire:keydown.escape.window="openContactShowModal({{$jiri->id}})" wire:click.self="openContactShowModal({{$jiri->id}})">
            <div class="modal__contentContainer modal__contentContainer--updateContactModal">
                <div class="modal__contentContainer__content">
                    <a wire:click="openContactShowModal({{$jiri->id}})" class="modal__contentContainer__content__closeContainer">
                        <svg class="modal__contentContainer__content__closeContainer__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </a>
                    <div class="modal__contentContainer__content__formContainer">
                        <form wire:submit="updateContact" class="form modal__contentContainer__content__formContainer__form">
                            <h2 class="modal__contentContainer__content__formContainer__form__title">{{__("Edit jiri project")}}</h2>


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
