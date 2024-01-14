<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactsList extends Component
{
    public $contacts;
    protected $listeners = ['refreshContactList' => 'refreshContactList'];
    public array $selectedContacts = [];
    public bool $actionsDisabled = true;

    public function mount(): void
    {
        $this->contacts = Auth::user()->contacts()->get();
    }
    public function render()
    {
        $this->actionsDisabled = count($this->selectedContacts) < 1;
        return view('livewire.contacts.contacts-list');
    }

    // Refresh the contacts list by getting all the user his contacts
    public function refreshContactList(): void
    {
        $this->contacts = Auth::user()->contacts()->get();
    }

    public function cancelSelected(): void
    {
        $this->selectedContacts = [];
    }

    // Delete all the selected Projects
    public function deleteSelected(): void
    {
        Contact::query()->whereIn('id', $this->selectedContacts)->delete();
        $this->selectedContacts = [];
        $this->refreshContactList();
    }

    // Delete a project by passing the id
    public function deleteContact($contactId): void
    {
        Contact::destroy($contactId);
        $this->refreshContactList();
    }
}
