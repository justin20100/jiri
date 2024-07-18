<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class RegisterModal extends Component
{

    use WithFileUploads;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $uploadFile;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'uploadFile' => 'image|max:1500|nullable'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($this->uploadFile) {
            $this->uploadFile->store("public/avatars/");
            $validated['avatar'] = $this->uploadFile->hashName();
        } else {
            $validated['avatar'] = 'default.jpg';
        }
        event(new Registered($user = User::create($validated)));
        Auth::login($user);
        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }


    public function render()
    {
        return view('livewire.auth.register-modal');
    }
}
