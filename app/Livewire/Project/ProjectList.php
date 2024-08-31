<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectList extends Component
{
    protected $listeners = ['refreshProjectList' => 'refreshProjectList', 'confirmed' => 'onConfirmed', 'cancelled' => 'cancelSelected'];
    public bool $actionsDisabled = true;
    public array $selectedProjects = [];
    public array $projectsToDelete = [];
    public string $search = '';


    #[Computed]
    public function projects(): mixed
    {
        return Auth::user()->projects()
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->get();
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('title')
            ->get();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedProjects) < 1;
        return view('livewire.project.project-list');
    }

    // Selection helpers
    public function cancelSelected(): void
    {
        $this->selectedProjects = [];
    }

    // Verify if the selected projects have jiris and can be deleted and wait a confirmation
    public function deleteSelected(): void
    {
        $this->projectsToDelete = $this->selectedProjects;
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected projects?'),
            message: __('Only projects without jiris can be deleted.'));
    }

    // Delete a project by passing the id
    public function deleteProject($projectId): void
    {
        $this->projectsToDelete = [$projectId];
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected projects?'),
            message: __('Only projects without jiris can be deleted.'));
    }

    public function onConfirmed(): void
    {
        DB::transaction(function () {
            $projects = Project::whereIn('id', $this->projectsToDelete)->withCount('jirisProjects')->get();

            $undeletableProjects = [];
            $deletableProjects = [];

            foreach ($projects as $project) {
                if ($project->jiris_projects_count > 0) {
                    $undeletableProjects[] = $project->title;
                } else {
                    $deletableProjects[] = $project->title;
                    $project->delete();
                }
            }

            if (!empty($undeletableProjects)) {
                $this->dispatch('flashMessage', 'error', __('Project used in a Jiri'), implode(', ', $undeletableProjects));
            }
            if (!empty($deletableProjects)) {
                $this->dispatch('flashMessage', 'success', __('Successfully deleted'), implode(', ', $deletableProjects));
            }

            $this->selectedProjects = [];
            $this->projectsToDelete = [];
        });
    }
}
