<section class="projects">
    <div class="projects__contentContainer">
        <div class="projects__contentContainer__header">
            <h1 class="projects__contentContainer__header__title">{{__("Projets")}}</h1>
            <div class="projects__contentContainer__header__buttonsContainer">
                <div class="projects__contentContainer__header__buttonsContainer__deleteContainer">
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
                </div>
                {{--                TODO: add filter--}}
                {{--                <div class="projects__contentContainer__header__buttonsContainer__filterContainer">--}}
                {{--                    <div class="projects__contentContainer__header__buttonsContainer__filterContainer__filter">--}}
                {{--                        <x-input-label for="sort" :value="__('Trier par')"/>--}}
                {{--                        <select id="sort" name="sort" required autocomplete="sort" class="select">--}}
                {{--                            <option value="">{{__('Date de création')}}</option>--}}
                {{--                            <option value="">{{__('Titre')}}</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="projects__contentContainer__header__buttonsContainer__buttonContainer">
                    <livewire:projects.project-create-dialog/>
                </div>
            </div>
        </div>
        @if($this->projects->isEmpty())
            <div class="projects__contentContainer__tableEmpty">
                {{--                TODO: add image--}}
                {{--                <img src="" alt="">--}}
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("C'est ici que vous pouvez retrouver tous les projets que vous avez crées. Mais vous n'avez pas encore de projets alors ajoutez en un pour pouvoir anticiper la création d'un Jiri.")}}
                </p>
                <livewire:projects.project-create-dialog/>
            </div>
        @else
            <div class="projects__contentContainer__tableContainer">

                <livewire:tools.confirm-modal></livewire:tools.confirm-modal>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="projects__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                    <tr class="table__head__line table__head__line--projects">
                        <th class="table__head__line__cell table__head__line__cell--select">
                            {{-- select  --}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--title">
                            {{__("Titre")}}
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








