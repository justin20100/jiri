<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriInfosForm;
use App\Livewire\Forms\JiriProjectForm;
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



    // ----------- Jiris Infos
    public $jiri;
    public JiriInfosForm $jiriInfosForm;
    public function initializeANewJiri(){
        // Create a draft jiri for the user When the modal is opened
        $this->jiri = Auth::user()->jiris()->create(
            [
                'name' => $this->jiriInfosForm->name,
                'start' => now('Europe/Brussels')->add(1, 'day'),
                'end' => now('Europe/Brussels')->add(2, 'day'),
                'status' => 'draft',
            ]
        );
        $this->dispatch('refreshJiriList');

        // Fill the form with the jiri's datas
        $this->jiriInfosForm->name = $this->jiri->name;
        $this->jiriInfosForm->start = $this->jiri->start->format("Y-m-d\TH:i");
        $this->jiriInfosForm->end = $this->jiri->end->format("Y-m-d\TH:i");
    }
    public function updateJiriInfos(){
        $this->jiriInfosForm->validate();
        $this->jiriInfosForm->update($this->jiri);
        $this->showProjectsStep();
        $this->dispatch('refreshJiriList');
    }



    // ----------- Projects
    public JiriProjectForm $jiriProjectForm;
    #[Computed]
    public function projects()
    {
        return Auth::user()->projects->sortBy('title')->diff($this->jiriProjectForm->selectedProjects);
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects->sortBy('title')->diff($this->jiriProjectForm->selectedProjects);
    }
    public function addProjectToSelectedProjects($projectId): void
    {
        $project = Project::find($projectId);
        $this->jiriProjectForm->selectedProjects[] = $project;
    }
    public function removeProjectFromSelectedProjects($projectId): void
    {
        $project = Project::find($projectId);
        $this->jiriProjectForm->selectedProjects = array_diff($this->jiriProjectForm->selectedProjects, [$project]);
    }
    public function updateLinkedProjectsToAJiri(){
        $this->jiriProjectForm->validate();

        // Delete the unselected projects
        $projectsToDelete = $this->jiri->jiriProjects->diff($this->jiriProjectForm->selectedProjects);
        foreach ($projectsToDelete as $project){
            $this->jiriProjectForm->delete($this->jiri->id, $project->id);
        }

        // Add the selected projects
        foreach ($this->jiriProjectForm->selectedProjects as $project){
            $this->jiriProjectForm->create($this->jiri->id, $project->id);
        }
        $this->showContactsStep();
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
