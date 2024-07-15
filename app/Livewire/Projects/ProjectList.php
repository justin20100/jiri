<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectList extends Component
{
    public $projects;
    protected $listeners = ['refreshProjectList' => 'refreshProjectList'];
    public array $selectedProjects = [];
    public bool $actionsDisabled = true;

    public function mount(): void
    {
        $this->projects = Auth::user()->projects()->get();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedProjects) < 1;
        return view('livewire.projects.project-list');
    }

    // Refresh the projects list by getting all the user his projects
    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()->get();
    }

    public function cancelSelected(): void
    {
        $this->selectedProjects = [];
    }

    // Delete all the selected Projects
    public function deleteSelected(): void
    {
        Project::query()->whereIn('id', $this->selectedProjects)->delete();
        $this->selectedProjects = [];
        $this->refreshProjectList();
    }

    // Delete a project by passing the id
    public function deleteProject($projectId): void
    {
        Project::destroy($projectId);
        $this->refreshProjectList();
    }
}
