<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class ConfirmModal extends Component
{
    public bool $show = false;
    public string $titleMessage = '';
    public string $message = '';
    public string $context = '';
    protected $listeners = ['checkConfirm' => 'checkConfirm',];


    public function render()
    {
        return view('livewire.tools.confirm-modal', [
            'show'=> $this->show,
            'titleMessage' => $this->titleMessage,
            'message' => $this->message,
        ]);
    }

    public function checkConfirm($titleMessage = '', $message = '', $context=''): void
    {
        $this->show = true;
        $this->titleMessage = $titleMessage;
        $this->message = $message;
        $this->context = $context;
    }

    public function confirm(): void
    {
        $this->show = false;

        if ($this->context == 'deleteList') {
            $this->dispatch('confirmedDeleteList');
        } elseif ($this->context == 'deleteShow') {
            $this->dispatch('confirmedDeleteShow');
        } elseif ($this->context == 'deleteProfile'){
            $this->dispatch('confirmedDeleteProfile');
        }
    }

    public function cancel(): void
    {
        $this->show = false;
        $this->dispatch('cancelled');
    }
}
