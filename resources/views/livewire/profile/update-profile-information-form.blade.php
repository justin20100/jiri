<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public $avatar = '';
    public $uploadFile;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->firstname = Auth::user()->firstname;
        $this->lastname = Auth::user()->lastname;
        $this->email = Auth::user()->email;
        $this->avatar = Auth::user()->avatar;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'uploadFile' => 'image|max:1500|nullable',
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($this->uploadFile) {
            $this->uploadFile->store("images/avatars/");
            $validated['avatar'] = $this->uploadFile->hashName();
        } else {
            $validated['avatar'] = 'default.jpg';
        }

        $user->save();

        $this->dispatch('flashMessage', 'success', __("Profile updated successfully"));
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="profileInfos">
    <header class="profileInfos__header">
        <h2 class="profileInfos__header__title">
            {{ __('Profil information') }}
        </h2>

        <p class="profileInfos__header__text">
            {{ __("You can edit your infos here") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="profileInfos__form form">

        <!-- Avatar -->
        <div class="form__avatar">
            <div class="form__avatar__preview">
                @if ($uploadFile)
                    <img src="{{ $uploadFile->temporaryUrl() }}">
                @else
                    <img src="{{URL::to('/storage/avatars')."/".$avatar}}">
                @endif
            </div>

            <label class="form__avatar__label" for="form__avatar__label__iconWrapper__input">
                <div class="form__avatar__label__iconWrapper">
                    <input type="file" wire:model="uploadFile" id="form__avatar__label__iconWrapper__input"/>
                    <svg class="form__avatar__label__iconWrapper__icon">
                        <use xlink:href="{{asset("images/sprite.svg#pencil")}}"></use>
                    </svg>
                </div>
            </label>

            @error('uploadFile') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form__columns">
            <!-- Firstname -->
            <div class="form__firstname">
                <x-input-label for="firstname" :value="__('Firstname')" />
                <x-text-input wire:model="firstname" id="firstname" name="firstname" type="text" class="" required autofocus autocomplete="firstname" />
                <x-input-error class="" :messages="$errors->get('firstname')" />
            </div>

            <!-- Lastname -->
            <div class="form__lastname">
                <x-input-label for="lastname" :value="__('Lastname')" />
                <x-text-input wire:model="lastname" id="lastname" name="lastname" type="text" class="" required autofocus autocomplete="lastname" />
                <x-input-error class="" :messages="$errors->get('lastname')" />
            </div>
        </div>

        <!-- email -->
        <div class="form__email">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="" required autocomplete="username" />
            <x-input-error class="" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form__buttonContainer">
            <x-primary-button>{{ __('Save changes') }}</x-primary-button>

            <x-action-message class="" on="profile-updated">
                {{ __('Iformations modifiées') }}
            </x-action-message>
        </div>
    </form>
</section>
