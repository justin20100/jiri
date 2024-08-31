<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class FlashMessage extends Component
{
    public $successName;
    public $errorName;

    public function mount($successName, $errorName): void
    {
        $this->successName = $successName;
        $this->errorName = $errorName;
    }

    public function render()
    {
        return view('livewire.tools.flash-message');
    }
}
