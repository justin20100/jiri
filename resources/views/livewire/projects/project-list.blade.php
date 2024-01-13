<section class="projects">
    <div class="projects__contentContainer">
        <div class="projects__contentContainer__header">
            <h1 class="projects__contentContainer__header__title">{{__("Projets")}}</h1>
            <div class="projects__contentContainer__header__buttonsContainer">
                <div class="projects__contentContainer__header__buttonsContainer__deleteContainer">
                    <button wire:click.prevent="deleteSelected" onclick="confirm('suprimer ces projets ?')|| event.stopImmediatePropagation()"
                            class="projects__contentContainer__header__buttonsContainer__deleteContainer__button  button">
                        {{--                            <svg class="projects__contentContainer__header__buttonsContainer__deleteContainer__button__svg">--}}
                        {{--                                <use xlink:href="{{asset("images/sprite.svg#delete")}}"></use>--}}
                        {{--                            </svg>--}}
                        <span class="projects__contentContainer__header__buttonsContainer__deleteContainer__button__text">{{__("Supprimer")}}</span>
                    </button>
                </div>
                <div class="projects__contentContainer__header__buttonsContainer__filterContainer">
                    <div class="projects__contentContainer__header__buttonsContainer__filterContainer__filter">
                        <x-input-label for="sort" :value="__('Trier par')"/>
                        <select id="sort" name="sort" required autocomplete="sort" class="select">
                            <option value="">{{__('Date de création')}}</option>
                            <option value="">{{__('Titre')}}</option>
                        </select>
                    </div>
                </div>
                <div class="projects__contentContainer__header__buttonsContainer__buttonContainer">
                    <livewire:projects.project-create-dialog/>
                </div>
            </div>
        </div>
        <div class="projects__contentContainer__tableContainer">
            <table class="projects__contentContainer__tableContainer__table table">
                <thead class="table__head">
                <tr class="table__head__line">
                    <th class="table__head__line__cell">
                        {{-- select  --}}
                    </th>
                    <th class="table__head__line__cell">
                        {{__("Titre")}}
                    </th>
                    <th class="table__head__line__cell">
                        {{__("Description")}}
                    </th>
                    <th class="table__head__line__cell">
                        {{-- more--}}
                    </th>
                </tr>
                </thead>
                <tbody class="table__body">
                @foreach($this->projects as $project)
                    <tr class="table__body__line">
                        <td class="table__body__line__cell">
                            <input type="checkbox" wire:model="selectedProjects" value="{{$project->id}}" class="table__body__line__cell__checkbox">
                        </td>
                        <td class="table__body__line__cell">
                            {{$project->title}}
                        </td>
                        <td class="table__body__line__cell">
                            {{ \Illuminate\Support\Str::limit($project->description, 100, $end='...') }}
                        </td>
                        <td class="table__body__line__cell">
                            {{--  icon avec trois petits points pour afficher le mini dialog --}}
{{--                            <div class="table__body__line__cell__icon">--}}
{{--                                <svg class="table__body__line__cell__icon__svg">--}}
{{--                                    <use xlink:href="{{asset("images/sprite.svg#more")}}"></use>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
                            <div class="table__body__line__cell__actions">
                                <a href="{{route('projects.edit', $project->id)}}" class="table__body__line__cell__actions__edit">
                                    <svg class="table__body__line__cell__actions__edit__svg">
                                        <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                    </svg>
                                </a>
                                <button wire:click="deleteProject({{$project->id}})" wire:click.prevent="deleteSelected" onclick="confirm('Suprimer ce projet ?')|| event.stopImmediatePropagation()" class="table__body__line__cell__actions__delete">
                                    <svg class="table__body__line__cell__actions__delete__svg">
                                        <use xlink:href="{{asset("images/sprite.svg#trash1")}}"></use>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>








