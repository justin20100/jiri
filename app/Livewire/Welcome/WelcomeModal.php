<?php

namespace App\Livewire\Welcome;

use Livewire\Component;

class WelcomeModal extends Component
{
    public function render()
    {
        return view('livewire.welcome.welcome-modal');
    }

    protected $listeners = [
        'openLoginModal' => 'openLoginModal',
        'openRegisterModal' => 'openRegisterModal',
        'closeWelcomeModal' => 'closeWelcomeModal',
    ];

    // ---------- Modal
    public $isOpen = "none";

    public function openLoginModal(): void
    {
        $this->isOpen = "login";
    }

    public function openRegisterModal(): void
    {
        $this->isOpen = "register";
    }

    public function closeWelcomeModal(): void
    {
        $this->isOpen = "none";
    }

//    add an event listener to listen escape keydown event


}
