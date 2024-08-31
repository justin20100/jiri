<?php

namespace App\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshContactList' => 'refreshContactList', 'confirmed' => 'onConfirmed', 'cancelled' => 'cancelSelected'];
    public bool $actionsDisabled = true;
    public array $selectedContacts = [];
    public array $contactsToDelete = [];
    public string $search = '';

    #[Computed]
    public function contacts(): mixed
    {
        return Auth::user()->contacts()
            ->where(function($query) {
                $query->where('firstname', 'like', '%' . $this->search . '%')
                    ->orWhere('lastname', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('firstname')
            ->get();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedContacts) < 1;
        return view('livewire.contact.contact-list');
    }

    // Refresh the contacts list by getting all the user his contacts
    public function refreshContactList(): void
    {
        $this->contacts = Auth::user()->contacts()
            ->where(function($query) {
                $query->where('firstname', 'like', '%' . $this->search . '%')
                    ->orWhere('lastname', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('firstname')
            ->get();
    }
    public function cancelSelected(): void
    {
        $this->selectedContacts = [];
    }

    // Delete all the selected Projects
    public function deleteSelected(): void
    {
        $this->contactsToDelete = $this->selectedContacts;
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected contacts?'),
            message: __('Only contacts unused in a jiri can be deleted.'));
    }

    // Delete a project by passing the id
    public function deleteContact($contactId): void
    {
        $this->contactsToDelete = [$contactId];
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected contact?'),
            message: __('Only contacts unused in a jiri can be deleted.'));
    }


    public function onConfirmed(): void
    {
        $contacts = Contact::whereIn('id', $this->contactsToDelete)
            ->withCount('contactsJiris')
            ->get();

        $undeletableContacts = [];
        $deletableContacts = [];

        foreach ($contacts as $contact) {
            if ($contact->contacts_jiris_count > 0) {
                $undeletableContacts[] = $contact->firstname . ' ' . $contact->lastname;
            } else {
                $deletableContacts[] = $contact->firstname . ' ' . $contact->lastname;
                $contact->delete();
            }
        }

        if (!empty($undeletableContacts)) {
            session()->flash('error', implode(', ', $undeletableContacts));
        }
        if (!empty($deletableContacts)) {
            session()->flash('success', implode(', ', $deletableContacts));
        }

        $this->selectedContacts = [];
        $this->contactsToDelete = [];

        $this->refreshContactList();
    }
}
