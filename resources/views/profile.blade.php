<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        --}}
{{--    </x-slot>--}}

    <div class="profile">
        <div class="profile__contentContainer">

            <h2 class="profile__contentContainer__title">
                {{ __('Profile') }}
            </h2>

            <div class="profile__contentContainer__infos">
                <div class="profile__contentContainer__infos__formContainer">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="profile__contentContainer__password">
                <div class="profile__contentContainer__password__formContainer">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="profile__contentContainer__delete">
                <div class="profile__contentContainer__delete__formContainer">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
