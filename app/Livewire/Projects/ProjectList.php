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

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()->get();
    }

    public function deleteSelected(): void
    {
        Project::query()->whereIn('id', $this->selectedProjects)->delete();
        $this->selectedProjects = [];
        $this->selectAll = false;
        $this->refreshProjectList();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedProjects)<1;
        return view('livewire.projects.project-list');
    }
}
