<?php

namespace App\Livewire\Forms;

use App\Models\Jiri;
use App\Models\JiriProject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JiriProjectForm extends Form
{
    #[Validate('required')]
    public $selectedProjects = [];


    public function rules()
    {
        return [
            'selectedProjects' => ['required', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'selectedProjects.required' => 'You need to select at least one project.',
            'selectedProjects.min' => 'You need to select at least one project.',
        ];
    }

    public function create($jiriId, $projectId): void
    {
        $this->validate();
        JiriProject::create(['jiri_id' => $jiriId, 'project_id' => $projectId]);
    }

    public function delete($jiriId, $projectId): void
    {
        $this->validate();
        JiriProject::where('jiri_id', $jiriId)->where('project_id', $projectId)->delete();
    }
}
