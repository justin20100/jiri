<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriForm;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class JiriCreateModal extends Component
{

    public function render()
    {
        return view('livewire.jiri.jiri-create-modal');
    }

    // ---------- Modal
    public bool $isOpen = false;
    public function openModal(): void
    {
        $this->isOpen = true;
        $this->initializeANewJiri();
    }
    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    // ----------- Jiris
    public $jiri;
    public JiriForm $form;

    // initialize a new empty jiri
    public function initializeANewJiri(){
        $this->form->name = "";
        $this->form->start = now('Europe/Brussels')->add(1, 'day')->format("Y-m-d\TH:i");
        $this->form->end = now('Europe/Brussels')->add(2, 'day')->format("Y-m-d\TH:i");

        $this->jiri = Auth::user()->jiris()->create(
            [
                'name' => $this->form->name,
                'start' => now('Europe/Brussels')->add(1, 'day'),
                'end' => now('Europe/Brussels')->add(2, 'day'),
                'status' => 'draft',
            ]
        );
    }
    public function update(){
        $this->form->update($this->jiri);
    }

    // ----------- Projects
    public $selectedProjects = [];

    #[Computed]
    public function projects()
    {
        return Auth::user()->projects->sortByDesc('title')->diff($this->selectedProjects);
    }

    public function addProjectToJiri($projectId)
    {
        $project = Project::find($projectId);
        $this->selectedProjects[] = $project;
        $this->form->addProject($project);
    }

    // ----------- Contacts
    public $selectedContacts = [];

    #[Computed]
    public function contacts()
    {
        return Auth::user()->contacts->sortByDesc('lastname');
    }

}
