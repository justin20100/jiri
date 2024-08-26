<?php

namespace App\Livewire\Forms;

use App\Models\Jiri;
use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JiriInfosForm extends Form
{
    #[Validate('required|min:2|max:255')]
    public $name = '';

    public $start;
    public $end;

    public Jiri $jiri;

    public function rules()
    {
        return [
            'start' => ['required', 'date', 'before:end'],
            'end' => ['required', 'date', 'after:start'],
        ];
    }

    public function messages()
    {
        return [
            'start.before' => 'The start date should be before the end date.',
            'end.after' => 'The end date should be after the start date.',
        ];
    }

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
