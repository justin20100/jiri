<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class ProjectShowModal extends Component
{

    // ---------- Modal
    public $projectShowIsOpen = "";
    public Project $project;

    protected $listeners = ['openProjectShowModal'=>'openProjectShowModal', 'openProjectUpdateModal'=>'openProjectUpdateModal', 'closeModal'=>'closeModal', 'confirmedDeleteShow' => 'confirmedDeleteShow'];

    public function openProjectShowModal($projectId): void
    {
        $this->projectShowIsOpen = "show";
        $this->project = Project::find($projectId);
    }
    public function openProjectUpdateModal($projectId): void
    {
        $this->projectShowIsOpen = "update";
        $this->project = Project::find($projectId);
        $this->projectForm->title = $this->project->title;
        $this->projectForm->description = $this->project->description;
    }
    public function closeProjectShowModal(): void
    {
        $this->reset('project', 'projectForm', 'projectShowIsOpen');
    }

    // ----------- PROJECTS
    public ProjectForm $projectForm;

    public function updateProject(): void
    {
        $title = $this->projectForm->title;
        $this->projectForm->update($this->project->id);
        $this->dispatch('flashMessage', 'success', __("Project successfully updated"), $title);
        $this->dispatch('refreshProjectList');
        $this->openProjectShowModal($this->project->id);
    }

    public function deleteProject(): void
    {
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure to delete ?'),
            message: __('Only projects without jiris can be deleted.'),
            context: 'deleteShow'
        );
    }

    public function confirmedDeleteShow(): void
    {
        $title = $this->project->title;

        if ($this->project->jirisProjects()->count() > 0) {
            $this->dispatch('flashMessage', 'error', __("Project used in a Jiri"), $title);
        } else {
            $this->dispatch('flashMessage', 'success', __("Project successfully deleted"), $title);
            $this->project->delete();
            $this->closeProjectShowModal();
        }

        $this->dispatch('refreshProjectList');
    }

    public function render()
    {
        return view('livewire.project.project-show-modal');
    }
}
