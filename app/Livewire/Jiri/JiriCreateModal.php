<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriContactForm;
use App\Livewire\Forms\JiriEvaluatorForm;
use App\Livewire\Forms\JiriInfosForm;
use App\Livewire\Forms\JiriProjectForm;
use App\Livewire\Forms\JiriStudentForm;
use App\Models\JiriProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class JiriCreateModal extends Component
{
    protected $listeners = ['refreshProjectList' => 'refreshProjectList', 'refreshContactList' => 'refreshContactList'];
    public function render()
    {
        return view('livewire.jiri.jiri-create-modal');
    }

    // ---------- Modal
    public $step = "infos";
    public bool $isOpen = false;
    public function openModal(): void
    {
        $this->isOpen = true;
        $this->initializeANewJiri();
    }
    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->dispatch('flashMessage', 'success', __("Jiri successfully created"), empty($this->jiri->name)?__('A jiri with no title has been created.'): $this->jiri->name);

        $this->dispatch('refreshJiriList');
        $this->reset();
    }
    public function showStep($nextStep): void
    {
        // STEPS -> infos, projects, contacts, summary
        if ($this->step == "infos") {
            $this->updateJiriInfos();
        }
        elseif ($this->step == "project") {
            $this->updateLinkedProjectsToAJiri();
        }
        elseif ($this->step == "evaluator") {
            $this->updateLinkedEvaluatorToAJiri();
        }
        elseif ($this->step == "student") {
            $this->updateLinkedStudentToAJiri();
        }
        elseif ($this->step == "summary") {
            $this->closeModal();
        }

        $this->step = $nextStep;
    }

    // ----------- Jiris Infos
    public $jiri;
    public $successJiriInfos = false;
    public JiriInfosForm $jiriInfosForm;
    public function initializeANewJiri(): void{
        // Create a draft jiri for the user When the modal is opened
        $this->jiri = Auth::user()->jiris()->create(
            [
                'name' => $this->jiriInfosForm->name,
                'start' => now('Europe/Brussels')->add(1, 'day'),
                'end' => now('Europe/Brussels')->add(2, 'day'),
                'status' => 'draft',
            ]
        );
        $this->dispatch('refreshJiriList');

        // Fill the form with the jiri's datas
        $this->jiriInfosForm->name = $this->jiri->name;
        $this->jiriInfosForm->start = $this->jiri->start->format("Y-m-d\TH:i");
        $this->jiriInfosForm->end = $this->jiri->end->format("Y-m-d\TH:i");
    }
    public function updateJiriInfos(): void{
        $this->successJiriInfos = false;
        $this->jiriInfosForm->validate();
        $this->jiriInfosForm->update($this->jiri);
        $this->successJiriInfos = true;
        $this->dispatch('refreshJiriList');
    }



    // ----------- Projects
    public JiriProjectForm $jiriProjectForm;
    public $successJiriProject = false;
    #[Computed]
    public function projects()
    {
        return Auth::user()->projects->sortBy('title')->diff($this->jiriProjectForm->selectedProjects);
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects->sortBy('title')->diff($this->jiriProjectForm->selectedProjects);
    }
    public function addProjectToSelectedProjects($projectId): void
    {
        $project = Project::find($projectId);
        $this->jiriProjectForm->selectedProjects[] = $project;
        $this->jiriProjectForm->validate();
    }
    public function removeProjectFromSelectedProjects($projectId): void
    {
        $project = Project::find($projectId);
        $this->jiriProjectForm->selectedProjects = array_diff($this->jiriProjectForm->selectedProjects, [$project]);
    }
    public function updateLinkedProjectsToAJiri(): void{
        $this->jiriProjectForm->validate();

        // Delete the unselected projects
        $projectsToDelete = $this->jiri->jiriProjects->diff($this->jiriProjectForm->selectedProjects);
        foreach ($projectsToDelete as $project){
            $this->jiriProjectForm->delete($this->jiri->id, $project->id);
        }

        // Add the selected projects
        foreach ($this->jiriProjectForm->selectedProjects as $project){
            $this->jiriProjectForm->create($this->jiri->id, $project->id);
        }
        $this->successJiriProject = true;
    }



    // ----------- Contacts
    #[Computed]
    public function contacts()
    {
        return Auth::user()->contacts->sortByDesc('lastname')->diff($this->jiriEvaluatorForm->selectedEvaluator)->diff($this->jiriStudentForm->selectedStudent);
    }

    public function refreshContactList(): void
    {
        $this->contacts =Auth::user()->contacts->sortByDesc('lastname')->diff($this->jiriEvaluatorForm->selectedEvaluator)->diff($this->jiriStudentForm->selectedStudent);
    }

    // ---- Evaluators
    public JiriEvaluatorForm $jiriEvaluatorForm;
    public $successJiriEvaluator = false;
    public function addContactToSelectedEvaluator($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriEvaluatorForm->selectedEvaluator[] = $contact;
        $this->jiriEvaluatorForm->validate();
    }
    public function removeContactFromSelectedEvaluator($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriEvaluatorForm->selectedEvaluator = array_diff($this->jiriEvaluatorForm->selectedEvaluator, [$contact]);
    }
    public function updateLinkedEvaluatorToAJiri(): void
    {
        $this->jiriEvaluatorForm->validate();

        // Delete the unselected evaluators
        $evaluatorsToDelete = $this->jiri->contactJiris->diff($this->jiriEvaluatorForm->selectedEvaluator);
        foreach ($evaluatorsToDelete as $evaluator){
            $this->jiriEvaluatorForm->delete($this->jiri->id, $evaluator->id);
        }

        // Add the selected evaluators
        foreach ($this->jiriEvaluatorForm->selectedEvaluator as $evaluator){
            $this->jiriEvaluatorForm->create($this->jiri->id, $evaluator->id);
        }

        $this->successJiriEvaluator = true;
    }

    // ---- Students
    public JiriStudentForm $jiriStudentForm;
    public $successJiriStudent = false;
    public function addContactToSelectedStudent($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriStudentForm->selectedStudent[] = $contact;
        $this->jiriStudentForm->validate();
    }

    public function removeContactFromSelectedStudent($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriStudentForm->selectedStudent = array_diff($this->jiriStudentForm->selectedStudent, [$contact]);
    }
    public function updateLinkedStudentToAJiri(): void
    {
        $this->jiriStudentForm->validate();

        // Delete the unselected students
        $studentsToDelete = $this->jiri->contactJiris->diff($this->jiriStudentForm->selectedStudent);
        foreach ($studentsToDelete as $student){
            $this->jiriStudentForm->delete($this->jiri->id, $student->id);
        }

        // Add the selected students
        foreach ($this->jiriStudentForm->selectedStudent as $student){
            $this->jiriStudentForm->create($this->jiri->id, $student->id);
        }

        $this->successJiriStudent = true;
    }
}
