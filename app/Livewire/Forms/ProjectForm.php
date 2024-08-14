<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    #[Validate('required|min:2|max:255')]
    public $title = '';

    #[Validate('required|min:3|max:500|nullable')]
    public $description = '';

    public Project $project;

    public function create(): void
    {
        $this->validate();

        auth()->user()->projects()->create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', $this->title);

        $this->reset(['title', 'description']);
    }

    public function update(): void
    {
        $this->validate();

        $this->project->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
