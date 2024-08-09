<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class ConfirmModal extends Component
{
    public bool $show = false;
    public string $message = '';
    protected $listeners = ['checkConfirm' => 'checkConfirm',];


    public function render()
    {
        return view('livewire.tools.confirm-modal', [
            'show'=> $this->show,
            'message' => $this->message,
        ]);
    }

    public function checkConfirm($message): void
    {
        $this->show = true;
        $this->message = $message;
    }

    public function confirm(): void
    {
        $this->show = false;
        $this->dispatch('confirmed');
    }

    public function cancel(): void
    {
        $this->show = false;
        $this->dispatch('cancelled');
    }
}
