<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriForm;
use App\Models\JiriProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class JiriCreateModal extends Component
{
    protected $listeners = ['refreshProjectList' => 'refreshProjectList', 'refreshContactList' => 'refreshContactList'];
    public function render()
    {
        return view('livewire.jiri.jiri-create-modal');
    }

    // ---------- Modal
    public $step = "infos";
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

    public function showInfosStep(): void
    {
        $this->step = "infos";
    }
    public function showProjectsStep(): void
    {
        $this->step = "projects";
    }
    public function showContactsStep(): void
    {
        $this->step = "contacts";
    }
    public function showSummaryStep(): void
    {
        $this->step = "summary";
    }

    // ----------- Jiris
    public $jiri;
    public JiriForm $jiriForm;
    public function initializeANewJiri(){
        // Create a draft jiri for the user When the modal is opened
        $this->jiri = Auth::user()->jiris()->create(
            [
                'name' => $this->jiriForm->name,
                'start' => now('Europe/Brussels')->add(1, 'day'),
                'end' => now('Europe/Brussels')->add(2, 'day'),
                'status' => 'draft',
            ]
        );
        $this->dispatch('refreshJiriList');

        // Fill the form with the jiri's datas
        $this->jiriForm->name = $this->jiri->name;
        $this->jiriForm->start = $this->jiri->end->format("Y-m-d\TH:i");
        $this->jiriForm->end = $this->jiri->start->format("Y-m-d\TH:i");
    }
    public function updateJiriInfos(){
        $this->jiriForm->validate();
        $this->jiriForm->update($this->jiri);
        $this->showProjectsStep();
        $this->dispatch('refreshJiriList');
    }

    // ----------- Projects
    public $selectedProjects = [];
    #[Computed]
    public function projects()
    {
        return Auth::user()->projects->sortBy('title')->diff($this->selectedProjects);
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects->sortBy('title')->diff($this->selectedProjects);
    }
    public function addProjectToJiri($projectId): void
    {
        $project = Project::find($projectId);
        $this->selectedProjects[] = $project;
        JiriProject::create(['jiri_id' => $this->jiri->id, 'project_id' => $project->id]);
    }
    public function removeProjectFromJiri($projectId): void
    {
        $project = Project::find($projectId);
        $this->selectedProjects = array_diff($this->selectedProjects, [$project]);
        JiriProject::where('jiri_id', $this->jiri->id)->where('project_id', $project->id)->delete();
    }

    // ----------- Contacts
    public $selectedContacts = [];
    #[Computed]
    public function contacts()
    {
        return Auth::user()->contacts->sortByDesc('lastname');
    }

    public function refreshContactList()
    {
        $this->contacts->refresh();
    }
}
