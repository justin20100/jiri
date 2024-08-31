<section class="projects">

    {{--  ICONS BOX  --}}
        <div class="iconsBox @if(!$this->actionsDisabled) iconsBox--active @else iconsBox--inactive @endif">
            <div class="iconsBox__contentContainer">
                <div class="iconsBox__contentContainer__list">
                    <div class="iconsBox__contentContainer__list__item">
                        <button wire:click.prevent="deleteSelected"
                                class="iconsBox__contentContainer__list__item__button" title="{{__('Supprimer les éléments sélectionnés')}}">
                            <svg class="iconsBox__contentContainer__list__item__button__svg">
                                <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="iconsBox__contentContainer__closeButton">
                    <button wire:click.prevent="cancelSelected" class="iconsBox__contentContainer__closeButton__button" title="{{__('Annuler la sélection')}}">
                        <svg class="iconsBox__contentContainer__closeButton__button__svg">
                            <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    {{--  END ICONS BOX  --}}

    {{--  CONFIRM MODAL  --}}
        <livewire:tools.confirm-modal></livewire:tools.confirm-modal>
    {{--  END CONFIRM MODAL  --}}

    <div class="projects__contentContainer">
        <div class="projects__contentContainer__header">
            <div class="projects__contentContainer__header__top">
                <h1 class="projects__contentContainer__header__top__title">{{__("Projects")}}</h1>

                <x-dropdown-link class="projects__contentContainer__header__top__profileContainer" :href="route('profile')" wire:navigate>
                    <div class="projects__contentContainer__header__top__profileContainer__nameContainer">
                        <span class="projects__contentContainer__header__top__profileContainer__nameContainer__name">{{'Hello, '.Auth()->user()['firstname']}}</span>
                    </div>
                    <div class="projects__contentContainer__header__top__profileContainer__imgContainer">
                        <img src="{{URL::to('/storage/avatars')."/".Auth()->user()['avatar']}}" alt="" class="projects__contentContainer__header__top__profileContainer__imgContainer__img">
                    </div>
                </x-dropdown-link>
            </div>
            <div class="projects__contentContainer__header__bottom">
                <div class="projects__contentContainer__header__bottom__searchContainer">
                    <div class="projects__contentContainer__header__bottom__searchContainer__iconContainer">
                        <svg>
                            <use xlink:href="{{asset("images/sprite.svg#search")}}"></use>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce="search" class="projects__contentContainer__header__bottom__searchContainer__input" placeholder="{{__('Search in this list ...')}}">
                </div>
                <livewire:project.project-create-modal/>
            </div>
        </div>
        @if($this->projects->isEmpty() && $this->search == '')
            <div class="projects__contentContainer__tableEmpty">
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("This is where you can find all the projects you have created. But you don't have any projects yet so add one to anticipate the creation of a Jiri.")}}
                </p>
                <livewire:project.project-create-modal/>
            </div>
        @elseif($this->projects->isEmpty() && $this->search != '')
            <div class="projects__contentContainer__tableEmpty">
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("No results for this search !")}}
                </p>
            </div>
        @else
            <div class="projects__contentContainer__tableContainer">
                <table class="projects__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                    <tr class="table__head__line table__head__line--projects">
                        <th class="table__head__line__cell table__head__line__cell--select">
                            {{-- select  --}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--title">
                            {{__("Title")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--description" >
                            {{__("Description")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--more">
                            {{-- more--}}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table__body">
                    @foreach($this->projects as $project)
                        <tr class="table__body__line table__body__line--projects">
                            <td class="table__body__line__cell">
                                <input type="checkbox" wire:model.change="selectedProjects" value="{{$project->id}}" class="table__body__line__cell__checkbox">
                            </td>
                            <td class="table__body__line__cell">
                                {{$project->title}}
                            </td>
                            <td class="table__body__line__cell">
                                {{ \Illuminate\Support\Str::limit($project->description, 100, $end='...') }}
                            </td>
                            <td class="table__body__line__cell table__body__line__cell--actions">
                                <div class="table__body__line__cell__actions">
                                    <a href="{{route('projects.edit', $project->id)}}" class="table__body__line__cell__actions__edit">
                                        <svg class="table__body__line__cell__actions__edit__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </a>
                                    <button wire:click="deleteProject({{$project->id}})" class="table__body__line__cell__actions__delete">
                                        <svg class="table__body__line__cell__actions__delete__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>








