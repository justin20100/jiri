<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

class LoginModal extends Component
{
    public LoginForm $form;
    public bool $passwordVisible = false;

//    public function mount(): void
//    {
//        $this->form = new LoginForm();
//    }

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }

    public function togglePasswordVisibility(): void
    {
        $this->passwordVisible = ! $this->passwordVisible;
    }

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}
