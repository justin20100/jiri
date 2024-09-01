<?php

namespace App\Livewire\Welcome;

use Livewire\Component;

class WelcomeModal extends Component
{
    public bool $isOpen = false;
    public $modalType;

    // Liste des écouteurs d'événements
    protected $listeners = [
        'setModal' => 'setModal',
        'openForgotPasswordModal' => 'openForgotPasswordModal',
        'closeWelcomeModal' => 'closeWelcomeModal',
    ];

    public function render()
    {
        return view('livewire.welcome.welcome-modal');
    }

    public function setModal($modalType): void
    {
        if (!$this->isOpen) {
            $this->openWelcomeModal();
        }
        $this->modalType = $modalType;
    }

    public function openForgotPasswordModal(): void
    {
        $this->modalType = "forgotPassword";
    }

    public function openWelcomeModal(): void
    {
        $this->isOpen = true;
    }

    public function closeWelcomeModal(): void
    {
        $this->isOpen = false;
    }
}
