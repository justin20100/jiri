<section class="jiris">

    {{--  FLASH MESSAGES  --}}
    @if (session('success') || session('error'))
        <div class="flash">
            <div class="flash__container">
                @if (session('success'))
                    <div class="flash__container__type flash__container__type--success"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 8000)"
                         x-show="show">
                        <p class="flash__container__type__name">
                            {{__('Successfully deleted')}}
                        </p>
                        <p class="flash__container__type__message">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="flash__container__type flash__container__type--error"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 8000)"
                         x-show="show">
                        <p class="flash__container__type__name">
                            {{__('Delete failed')}}
                        </p>
                        <p class="flash__container__type__message">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif
    {{--  END FLASH MESSAGES  --}}

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
                    <input type="text" class="jiris__contentContainer__header__bottom__searchContainer__input" placeholder="{{__('Search in this list ...')}}">
                </div>
                <livewire:jiri.jiri-create-modal/>
            </div>
        </div>
        @if($this->jiris->isEmpty())
            <div class="jiris__contentContainer__tableEmpty">
                {{--                TODO: add image--}}
                {{--                <img src="" alt="">--}}
                <p class="jiris__contentContainer__tableEmpty__text">
                    {{__("C'est ici que vous pouvez retrouver tous les jiris que vous avez crées. Mais vous n'avez pas encore de jiris alors ajoutez en un !")}}
                </p>
                <a href="{{ route('jiris.create') }}" class="button">{{__("Add a Jiri")}}</a>
            </div>
        @else
            <div class="jiris__contentContainer__tableContainer">
                <livewire:tools.confirm-modal></livewire:tools.confirm-modal>
                <table class="jiris__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                    <tr class="table__head__line table__head__line--jiris">
                        <th class="table__head__line__cell table__head__line__cell--select">
                            {{-- select  --}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--title">
                            {{__("Titre")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--date" >
                            {{__("Début du Jiri")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--date">
                            {{__("Fin du Jiri")}}
                        </th>
                        <th class="table__head__line__cell table__head__line__cell--statut">
                            {{__("Statut")}}
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
