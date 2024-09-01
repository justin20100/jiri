<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class FlashMessage extends Component
{
    public $messages = [];

    protected $listeners = [
        'flashMessage' => 'addMessage'
    ];

    public function addMessage($type, $title, $message='')
    {
        $this->messages[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ];
    }

    public function removeMessage($index)
    {
        unset($this->messages[$index]);
        // Réindexer le tableau pour éviter des clés manquantes
        $this->messages = array_values($this->messages);
    }

    public function render()
    {
        return view('livewire.tools.flash-message');
    }
}
