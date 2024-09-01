<section class="jiris">

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

    <div class="jiris__contentContainer">
        <div class="jiris__contentContainer__header">
            <div class="jiris__contentContainer__header__top">
                <h1 class="jiris__contentContainer__header__top__title">{{__("Jiris")}}</h1>
                <x-dropdown-link class="jiris__contentContainer__header__top__profileContainer" :href="route('profile')" wire:navigate>
                    <div class="jiris__contentContainer__header__top__profileContainer__nameContainer">
                        <span class="jiris__contentContainer__header__top__profileContainer__nameContainer__name">{{'Hello, '.Auth()->user()['firstname']}}</span>
                    </div>
                    <div class="jiris__contentContainer__header__top__profileContainer__imgContainer">
                        <img src="{{URL::to('/storage/avatars')."/".Auth()->user()['avatar']}}" alt="" class="jiris__contentContainer__header__top__profileContainer__imgContainer__img">
                    </div>
                </x-dropdown-link>
            </div>
            <div class="jiris__contentContainer__header__bottom">
                <div class="jiris__contentContainer__header__bottom__searchContainer">
                    <div class="jiris__contentContainer__header__bottom__searchContainer__iconContainer">
                        <svg>
                            <use xlink:href="{{asset("images/sprite.svg#search")}}"></use>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce="search" class="jiris__contentContainer__header__bottom__searchContainer__input" placeholder="{{__('Search in this list ...')}}">
                </div>
                <livewire:jiri.jiri-create-modal/>
            </div>
        </div>
        @if($this->jiris->isEmpty() && $this->search == '')
            <div class="jiris__contentContainer__tableEmpty">
                <p class="jiris__contentContainer__tableEmpty__text">
                    {{__("C'est ici que vous pouvez retrouver tous les jiris que vous avez crées. Mais vous n'avez pas encore de jiris alors ajoutez en un !")}}
                </p>
                <livewire:jiri.jiri-create-modal/>
            </div>
        @elseif($this->jiris->isEmpty() && $this->search != '')
            <div class="jiris__contentContainer__tableEmpty">
                <p class="jiris__contentContainer__tableEmpty__text">
                    {{__("Nos results for this search !")}}
                </p>
            </div>
        @else
            <div class="jiris__contentContainer__tableContainer">
                <table class="jiris__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                        <tr class="table__head__line table__head__line--jiris">
                        <th class="table__head__line__cell table__head__line__cell--select">
                            {{-- select  --}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--title">
                            {{__("Title")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--date" >
                            {{__("Start date")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--date">
                            {{__("End date")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--statut">
                            {{__("Status")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--actions">
                            {{-- actions--}}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table__body">
                    @foreach($this->jiris as $jiri)
                        <tr class="table__body__line table__body__line--jiris">
                            <td class="table__body__line__cell">
                                <input type="checkbox" wire:model.change="selectedJiris" value="{{$jiri->id}}" class="table__body__line__cell__checkbox">
                            </td>
                            <td class="table__body__line__cell">
                                {{ \Illuminate\Support\Str::limit($jiri->name, 25, $end='...')  }}
                            </td>
                            <td class="table__body__line__cell">
                                {{ \Carbon\Carbon::parse($jiri->start)->format('d/m/Y H:i') }}
                            </td>
                            <td class="table__body__line__cell">
                                {{ \Carbon\Carbon::parse($jiri->end)->format('d/m/Y H:i') }}
                            </td>
                            <td class="table__body__line__cell">
                                <p class="table__body__line__cell__status
                                @if($jiri->status =="draft" )
                                    table__body__line__cell__status--orange
                                @elseif($jiri->status =="ongoing" )
                                    table__body__line__cell__status--green
                                @elseif($jiri->status =="ended" )
                                    table__body__line__cell__status--blue
                                @endif">
                                    {{ $jiri->status }}
                                </p>
                            </td>
                            <td class="table__body__line__cell table__body__line__cell--actions">
                                <div class="table__body__line__cell__actions">
                                    <a href="{{route('jiris.edit', $jiri->id)}}" class="table__body__line__cell__actions__edit">
                                        <svg class="table__body__line__cell__actions__edit__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </a>
                                    <button wire:click="deleteJiri({{$jiri->id}})" class="table__body__line__cell__actions__delete">
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
