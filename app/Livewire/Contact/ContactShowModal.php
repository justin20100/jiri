<?php

namespace App\Livewire\Contact;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithFileUploads;

class ContactShowModal extends Component
{
    use WithFileUploads;

    // ---------- Modal
    public $contactShowIsOpen = "";
    public Contact $contact;

    protected $listeners = ['openContactShowModal'=>'openContactShowModal', 'openContactUpdateModal'=>'openContactUpdateModal', 'closeModal'=>'closeModal', 'confirmedDeleteShow' => 'confirmedDeleteShow'];
    private string $savedAvatar = '';

    public function openContactShowModal($contactId): void
    {
        $this->contactShowIsOpen = "show";
        $this->contact = Contact::find($contactId);
    }
    public function openContactUpdateModal($contactId): void
    {
        $this->contactShowIsOpen = "update";
        $this->contact = Contact::find($contactId);
        $this->contactForm->firstname = $this->contact->firstname;
        $this->contactForm->lastname = $this->contact->lastname;
        $this->contactForm->email = $this->contact->email;
        $this->savedAvatar = $this->contact->avatar;
        $this->contactForm->avatar = $this->contact->avatar;
    }
    public function closeContactShowModal(): void
    {
        $this->reset('contact', 'contactForm', 'contactShowIsOpen');
    }

    // ----------- Contacts
    public ContactForm $contactForm;

    public function updateContact(): void
    {
        $fullName = $this->contactForm->firstname . ' ' . $this->contactForm->lastname;
        $this->contactForm->update($this->contact->id);
        $this->dispatch('flashMessage', 'success', __("Contact successfully edited"), $fullName);
        $this->dispatch('refreshContactList');
        $this->openContactShowModal($this->contact->id);
    }

    public function deleteContact(): void
    {
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure to delete ?'),
            message: __('Only contacts without jiris can be deleted.'),
            context: 'deleteShow'
        );
    }

    public function confirmedDeleteShow(): void
    {
        $fullName = $this->contact->firstname . ' ' . $this->contact->lastname;

        if ($this->contact->contactsJiris()->count() > 0) {
            $this->dispatch('flashMessage', 'error', __("Contact used in a Jiri"), $fullName);
        } else {
            $this->dispatch('flashMessage', 'success', __("Contact successfully deleted"), $fullName);
            $this->contact->delete();
            $this->closeContactShowModal();
        }

        $this->dispatch('refreshContactList');
    }

    public function render()
    {
        return view('livewire.contact.contact-show-modal');
    }
}
