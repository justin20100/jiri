<?php

namespace App\Livewire\Forms;

use App\Models\Jiri;
use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JiriForm extends Form
{
    #[Validate('required|min:2|max:255')]
    public $name = '';

    #[Validate('required|date')]
    public $start;
    public $end;

    public Jiri $jiri;

    public function create(): void
    {
        $this->validate();

        auth()->user()->jiris()->create([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        $this->reset(['name', 'start', 'end']);
    }

    public function update($jiri): void
    {
        $this->validate();
        $jiri->update([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
        ]);
    }

    public function addProject($project): void
    {
        $this->jiri->projects()->attach($project);
    }
}
