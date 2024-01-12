<?php

namespace App\Livewire\projects;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProjectList extends Component
{
    public $projects;
    protected $listeners = ['refreshProjectList' => 'refreshProjectList'];

    public function mount(): void
    {
        $this->projects = Auth::user()->projects()->get();
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()->get();
    }

    public function render()
    {
        return view('livewire.projects.project-list');
    }
}
