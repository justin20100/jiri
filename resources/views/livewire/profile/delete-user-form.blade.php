<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="profileDelete">
    <header class="profileDelete__header">
        <h2 class="profileDelete__header__title">
            {{ __('Suprimer le profil') }}
        </h2>

        <p class="profileDelete__header__text">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <x-danger-button class="button button--red"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Suprimer le profil') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="">

            <h2 class="">
                {{ __('Êtes-vous sûr(e) de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class=" form__password">
                <x-input-label for="password" value="{{ __('Password') }}" class="" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->get('password')" class="" />
            </div>

            <div class="form__buttonContainer">
                <x-secondary-button x-on:click="$dispatch('close')" class="button">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="button">
                    {{ __('Suprimer le profil') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
