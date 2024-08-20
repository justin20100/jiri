<?php

namespace App\Livewire\Project;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectCreateModal extends Component
{

    // ---------- DIALOG
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
        $this->form->create();
        $this->reset('isOpen');
        $this->dispatch('refreshProjectList');
    }

    public function render()
    {
        return view('livewire.project.project-create-modal');
    }
}
