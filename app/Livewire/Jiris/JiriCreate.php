<?php

namespace App\Livewire\Jiris;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JiriCreate extends Component
{
    public $projects;
    public $contacts;
    protected $listeners = [
        'refreshProjectList' => 'refreshProjectList',
        'refreshContactList' => 'refreshContactList',
    ];
    public array $selectedProjects = [];
    public array $selectedContacts = [];
    public bool $actionsDisabled = true;

    public function mount(): void
    {
        $this->projects = Auth::user()->projects()->orderBy('created_at', 'desc')->get();
        $this->contacts = Auth::user()->contacts()->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        $this->mount();
        return view('livewire.jiris.jiri-create');
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()->orderBy('created_at', 'desc')->get();
    }

    public function refreshContactList(): void
    {
        $this->contacts = Auth::user()->contacts()->orderBy('created_at', 'desc')->get();
    }

    public function removeProject($projectId): void
    {
        $this->selectedProjects = array_diff($this->selectedProjects, [$projectId]);
    }

    public function removecontact($contactId): void
    {
        $this->selectedContacts = array_diff($this->selectedContacts, [$contactId]);
    }

    public function deleteJiri($jiriId): void
    {
        $jiri = Jiri::findOrFail($jiriId);

        foreach ($jiri->jiriProjects as $jiriProject) {
            $jiriProject->contactDuties()->delete();
        }

        $jiri->contactJiris()->delete();
        $jiri->jiriProjects()->delete();
        $jiri->delete();

        $this->refreshJiriList();
    }
}
