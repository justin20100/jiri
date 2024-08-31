<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectCreateModal extends Component
{

    // ---------- Modal
    public bool $isOpen = false;

    public function openModal(): void
    {
        $this->isOpen = true;
    }
    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    // ----------- PROJECTS
    public ProjectForm $form;

    public function create(): void
    {
        $title = $this->form->title;
        $this->form->create();
        $this->dispatch('flashMessage', 'success', __("Project created"), $title);
        $this->dispatch('refreshProjectList');
        $this->reset('isOpen');
    }

    public function render()
    {
        return view('livewire.project.project-create-modal');
    }
}
