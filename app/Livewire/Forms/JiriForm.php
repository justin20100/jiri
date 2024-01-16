<?php

namespace App\Livewire\Forms;

use App\Models\Jiri;
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

    public function setJiri($jiri)
    {
        $this->jiri = $jiri;
        $this->name = $jiri->name;
        $this->start = $jiri->start;
        $this->end = $jiri->end;
    }

    public function create(): void
    {
        $this->validate();

        auth()->user()->jiris()->create([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        $this->reset(['title', 'description']);
    }

    public function update(): void
    {
        $this->validate();

        $this->jiri->update([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
        ]);
    }
}
