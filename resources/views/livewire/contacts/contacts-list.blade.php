<section class="contacts">

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
                            {{__('Successfully deleted :')}}
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
                            {{__('Not deleted because used in a jiri :')}}
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

    {{--  CONFIRM MODAL  --}}
    <livewire:tools.confirm-modal></livewire:tools.confirm-modal>
    {{--  END CONFIRM MODAL  --}}

    <div class="contacts__contentContainer">
        <div class="contacts__contentContainer__header">
            <h1 class="contacts__contentContainer__header__title">{{__("Contacts")}}</h1>
            <div class="contacts__contentContainer__header__buttonsContainer">
                <div class="contacts__contentContainer__header__buttonsContainer__deleteContainer">
                    <div class="iconsBox @if(!$this->actionsDisabled) iconsBox--active @else iconsBox--inactive @endif">
                        <div class="iconsBox__contentContainer">
                            <div class="iconsBox__contentContainer__list">
                                <div class="iconsBox__contentContainer__list__item">
                                    <button wire:click.prevent="deleteSelected"
                                            class="iconsBox__contentContainer__list__item__button" title="{{__('Supprimer les contacts sélectionnés')}}">
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
                {{--                <div class="contacts__contentContainer__header__buttonsContainer__filterContainer">--}}
                {{--                    <div class="contacts__contentContainer__header__buttonsContainer__filterContainer__filter">--}}
                {{--                        <x-input-label for="sort" :value="__('Trier par')"/>--}}
                {{--                        <select id="sort" name="sort" required autocomplete="sort" class="select">--}}
                {{--                            <option value="">{{__('Date de création')}}</option>--}}
                {{--                            <option value="">{{__('Titre')}}</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="contacts__contentContainer__header__buttonsContainer__buttonContainer">
                    <livewire:contacts.contact-create-dialog/>
                </div>
            </div>
        </div>
        @if($this->contacts->isEmpty())
            <div class="contacts__contentContainer__tableEmpty">
                {{--                TODO: add image--}}
                {{--                <img src="" alt="">--}}
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("C'est ici que vous pouvez retrouver tous les contacts que vous avez crées. Mais vous n'avez pas encore de contacts alors ajoutez en un pour pouvoir anticiper la création d'un Jiri.")}}
                </p>
                <livewire:contacts.contact-create-dialog/>
            </div>
            @else
            <div class="contacts__contentContainer__tableContainer">
                <table class="contacts__contentContainer__tableContainer__table table">
                    <thead class="table__head">
                        <tr class="table__head__line table__head__line--contacts">
                            <th class="table__head__line__cell table__head__line__cell--select">
                                {{-- select  --}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--avatar">
                                {{__("Avatar")}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--firstname">
                                {{__("Prénom")}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--lastname">
                                {{__("Nom")}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--email">
                                {{__("Email")}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--more">
                                {{-- more--}}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table__body">
                    @forelse($this->contacts as $contact)
                        <tr class="table__body__line table__body__line--contacts">
                            <td class="table__body__line__cell">
                                <input type="checkbox" wire:model.change="selectedContacts" value="{{$contact->id}}" class="table__body__line__cell__checkbox">
                            </td>
                            <td class="table__body__line__cell">
                                <div class="table__body__line__cell__avatar">
                                    <img src="{{URL::to('/storage/avatars')."/".$contact->avatar}}" alt="avatar" class="table__body__line__cell__avatar__img">
                                </div>
                            </td>
                            <td class="table__body__line__cell">
                                {{$contact->firstname}}
                            </td>
                            <td class="table__body__line__cell">
                                {{$contact->lastname}}
                            </td>
                            <td class="table__body__line__cell">
                                {{$contact->email}}
                            </td>
                            <td class="table__body__line__cell table__body__line__cell--actions">
                                <div class="table__body__line__cell__actions">
                                    <a href="{{route('contacts.edit', $contact->id)}}" class="table__body__line__cell__actions__edit">
                                        <svg class="table__body__line__cell__actions__edit__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                                        </svg>
                                    </a>
                                    <button wire:click="deleteContact({{$contact->id}})" class="table__body__line__cell__actions__delete">
                                        <svg class="table__body__line__cell__actions__delete__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#trash2")}}"></use>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="table__body__line">
                            <td class="table__body__line__cell" colspan="6">
                                <div class="table__body__line__cell__empty">
                                    {{__("Aucun contact")}}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>








