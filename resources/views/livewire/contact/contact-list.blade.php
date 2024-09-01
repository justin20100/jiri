<section class="contacts">

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

    {{--  CONTACT SHOW MODAL  --}}
    <livewire:contact.contact-show-modal></livewire:contact.contact-show-modal>
    {{--  END CONTACT SHOW MODAL  --}}

    <div class="contacts__contentContainer">
        <div class="contacts__contentContainer__header">
            <div class="contacts__contentContainer__header__top">
                <h1 class="contacts__contentContainer__header__top__title">{{__("Contacts")}}</h1>
                <x-dropdown-link class="contacts__contentContainer__header__top__profileContainer" :href="route('profile')" wire:navigate>
                    <div class="contacts__contentContainer__header__top__profileContainer__nameContainer">
                        <span class="contacts__contentContainer__header__top__profileContainer__nameContainer__name">{{'Hello, '.Auth()->user()['firstname']}}</span>
                    </div>
                    <div class="contacts__contentContainer__header__top__profileContainer__imgContainer">
                        <img src="{{URL::to('/storage/avatars')."/".Auth()->user()['avatar']}}" alt="" class="contacts__contentContainer__header__top__profileContainer__imgContainer__img">
                    </div>
                </x-dropdown-link>
            </div>
            <div class="contacts__contentContainer__header__bottom">
                <div class="contacts__contentContainer__header__bottom__searchContainer">
                    <div class="contacts__contentContainer__header__bottom__searchContainer__iconContainer">
                        <svg>
                            <use xlink:href="{{asset("images/sprite.svg#search")}}"></use>
                        </svg>
                    </div>
                    <input type="text" wire:model.live="search" class="contacts__contentContainer__header__bottom__searchContainer__input" placeholder="{{__('Search in this list ...')}}">
                </div>
                <livewire:contact.contact-create-modal/>
            </div>
        </div>
        @if($this->contacts->isEmpty() && $this->search == '')
            <div class="contacts__contentContainer__tableEmpty">
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("Here's where you can find all the contacts you've created. However, you don't have any contacts yet, so add one now to prepare for creating a Jiri.")}}
                </p>
                <livewire:contact.contact-create-modal/>
            </div>
        @elseif($this->contacts->isEmpty() && $this->search != '')
            <div class="contacts__contentContainer__tableEmpty">
                <p class="projects__contentContainer__tableEmpty__text">
                    {{__("No results for this search !")}}
                </p>
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
                                {{__("Firstname")}}
                            </th>
                            <th class="table__head__line__cell table__head__line__cell--lastname">
                                {{__("Lastname")}}
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
                                    <a wire:click.prevent="$dispatch('openContactShowModal', [{{ $contact->id }}])" class="table__body__line__cell__actions__show">
                                        <svg class="table__body__line__cell__actions__show__svg">
                                            <use xlink:href="{{asset("images/sprite.svg#eye")}}"></use>
                                        </svg>
                                    </a>
                                    <a wire:click.prevent="$dispatch('openContactUpdateModal', [{{ $contact->id }}])" class="table__body__line__cell__actions__edit">
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








