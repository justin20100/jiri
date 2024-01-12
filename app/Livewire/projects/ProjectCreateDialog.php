<?php

namespace App\Livewire\projects;

use App\Livewire\Forms\ProjectForm;
use Livewire\Component;

class ProjectCreateDialog extends Component
{

    // ---------- DIALOG
    public bool $isOpen = false;

    public function openDialog(): void
    {
        $this->isOpen = true;
    }

    public function closeDialog(): void
    {
        $this->isOpen = false;
    }

    // ----------- PROJECTS
    public ProjectForm $form;

    public function create(): void
    {
        $this->form->create();

        $this->reset('show');
    }

    public function render()
    {
        return view('livewire.projects.project-create-dialog');
    }
}
