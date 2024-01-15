<section class="jiris">
    <div class="jiris__contentContainer">
        <div class="jiris__contentContainer__header">
            <h1 class="jiris__contentContainer__header__title">{{__("Jiris")}}</h1>
            <div class="jiris__contentContainer__header__buttonsContainer">
                <div class="jiris__contentContainer__header__buttonsContainer__deleteContainer">
                    <div class="iconsBox @if(!$this->actionsDisabled) iconsBox--active @else iconsBox--inactive @endif">
                        <div class="iconsBox__contentContainer">
                            <div class="iconsBox__contentContainer__list">
                                <div class="iconsBox__contentContainer__list__item">
                                    <button wire:click.prevent="deleteSelected"  wire:confirm="suprimer ces jiris ?"
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
                {{--                <div class="jiris__contentContainer__header__buttonsContainer__filterContainer">--}}
                {{--                    <div class="jiris__contentContainer__header__buttonsContainer__filterContainer__filter">--}}
                {{--                        <x-input-label for="sort" :value="__('Trier par')"/>--}}
                {{--                        <select id="sort" name="sort" required autocomplete="sort" class="select">--}}
                {{--                            <option value="">{{__('Date de création')}}</option>--}}
                {{--                            <option value="">{{__('Titre')}}</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="jiris__contentContainer__header__buttonsContainer__buttonContainer">
                    <livewire:jiris.jiri-create-dialog/>
                </div>
            </div>
        </div>
        @if($this->jiris->isEmpty())
            <div class="jiris__contentContainer__tableEmpty">
                {{--                TODO: add image--}}
                {{--                <img src="" alt="">--}}
                <p class="jiris__contentContainer__tableEmpty__text">
                    {{__("C'est ici que vous pouvez retrouver tous les jiris que vous avez crées. Mais vous n'avez pas encore de jiris alors ajoutez en un !")}}
                </p>
                <livewire:jiris.jiri-create-dialog/>
            </div>
        @else
            <div class="jiris__contentContainer__tableContainer">
                <table class="jiris__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                    <tr class="table__head__line">
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
                    @foreach($this->jiris as $jiri)
                        <tr class="table__body__line">
                            <td class="table__body__line__cell">
                                <input type="checkbox" wire:model.change="selectedProjects" value="{{$jiri->id}}" class="table__body__line__cell__checkbox">
                            </td>
                            <td class="table__body__line__cell">
                                {{$jiri->title}}
                            </td>
                            <td class="table__body__line__cell">
                                {{ \Illuminate\Support\Str::limit($jiri->description, 100, $end='...') }}
                            </td>
                            <td class="table__body__line__cell">
                                {{--  icon avec trois petits points pour afficher le mini dialog --}}
                                {{--                            <div class="table__body__line__cell__icon">--}}
                                {{--                                <svg class="table__body__line__cell__icon__svg">--}}
                                {{--                                    <use xlink:href="{{asset("images/sprite.svg#more")}}"></use>--}}
                                {{--                                </svg>--}}
                                {{--                            </div>--}}
                                <div class="table__body__line__cell__actions">
                                    <a href="{{route('jiris.edit', $jiri->id)}}" class="table__body__line__cell__actions__edit">
                                        <svg class="table__body__line__cell__actions__edit__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </a>
                                    <button wire:click="deleteProject({{$jiri->id}})" wire:click.prevent="deleteSelected" onclick="confirm('Suprimer ce jiri ?')|| event.stopImmediatePropagation()" class="table__body__line__cell__actions__delete">
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
