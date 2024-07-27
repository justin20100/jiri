<?php

namespace App\Livewire\Welcome;

use Livewire\Component;

class WelcomeModal extends Component
{
    public function render()
    {
        return view('livewire.welcome.welcome-modal');
    }

    // ---------- Modal
    public $isOpen = "none";

    public function openLoginDialog(): void
    {
        $this->isOpen = "login";
    }

    public function openRegisterDialog(): void
    {
        $this->isOpen = "register";
    }

    public function closeWelcomeDialog(): void
    {
        $this->isOpen = "none";
    }
}
