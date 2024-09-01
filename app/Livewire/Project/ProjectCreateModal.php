<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectCreateModal extends Component
{

    // ---------- Modal
    public bool $projectCreateIsOpen = false;

    public function openProjectCreateModal(): void
    {
        $this->projectCreateIsOpen = true;
    }
    public function closeProjectCreateModal(): void
    {
        $this->projectCreateIsOpen = false;
    }

    // ----------- PROJECTS
    public ProjectForm $form;

    public function create(): void
    {
        $title = $this->form->title;
        $this->form->create();
        $this->dispatch('flashMessage', 'success', __("Project created"), $title);
        $this->dispatch('refreshProjectList');
        $this->reset('projectCreateIsOpen');
    }

    public function render()
    {
        return view('livewire.project.project-create-modal');
    }
}
