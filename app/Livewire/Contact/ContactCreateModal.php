<?php

namespace App\Livewire\Contact;

use App\Livewire\Forms\ContactForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactCreateModal extends Component
{
    use WithFileUploads;

    // ---------- Modal
    public bool $isOpen = false;

    public function openModal(): void
    {
        $this->isOpen = true;
    }
    public function closeModal(): void
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
        return view('livewire.contact.contact-create-modal');
    }
}
