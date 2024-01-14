<?php

namespace App\Livewire\Contacts;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactCreateDialog extends Component
{
    use WithFileUploads;

    // ---------- DIALOG
    public bool $isOpen = false;

    public function openDialog(): void
    {
        $this->isOpen = true;
    }

    public function closeDialog(): void
    {
        $this->isOpen = false;
    }

    // ----------- PROJECTS
    public ContactForm $form;

    public function create(): void
    {
        $this->form->create();
        $this->reset('isOpen');
        $this->dispatch('refreshContactList');
    }

    public function render()
    {
        return view('livewire.contacts.contact-create-dialog');
    }
}
