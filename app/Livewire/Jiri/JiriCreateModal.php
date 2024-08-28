<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriContactForm;
use App\Livewire\Forms\JiriInfosForm;
use App\Livewire\Forms\JiriProjectForm;
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
        session()->flash('success', empty($this->jiri->name)?__('A jiri with no title has been created.'): $this->jiri->name);
        $this->reset();
    }
    public function showStep($nextStep): void
    {
        // STEPS -> infos, projects, contacts, summary
        if ($this->step == "infos") {
            $this->updateJiriInfos();
        } elseif ($this->step == "project") {
            $this->updateLinkedProjectsToAJiri();
        } elseif ($this->step == "contact") {
            $this->updateLinkedContactsToAJiri();
        } elseif ($this->step == "summary") {
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
    public JiriContactForm $jiriContactForm;
    public $successJiriContact = false;
    #[Computed]
    public function contacts()
    {
        return Auth::user()->contacts->sortByDesc('lastname')->diff($this->jiriContactForm->selectedStudentContacts)->diff($this->jiriContactForm->selectedEvaluatorContacts);
    }

    public function refreshContactList(): void
    {
        $this->contacts =Auth::user()->contacts->sortByDesc('lastname')->diff($this->jiriContactForm->selectedStudentContacts)->diff($this->jiriContactForm->selectedEvaluatorContacts);
    }
    public function addContactToSelectedEvaluatorContacts($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriContactForm->selectedEvaluatorContacts[] = $contact;
        $this->jiriContactForm->validate();
    }
    public function removeContactFromSelectedEvaluatorContacts($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriContactForm->selectedEvaluatorContacts = array_diff($this->jiriContactForm->selectedEvaluatorContacts, [$contact]);
    }
    public function addContactToSelectedStudentContacts($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriContactForm->selectedStudentContacts[] = $contact;
        $this->jiriContactForm->validate();
    }
    public function removeContactFromSelectedStudentContacts($contactId): void
    {
        $contact = Auth::user()->contacts->find($contactId);
        $this->jiriContactForm->selectedStudentContacts = array_diff($this->jiriContactForm->selectedStudentContacts, [$contact]);
    }
    public function updateLinkedContactsToAJiri(): void
    {
        $this->jiriContactForm->validate();

        // Delete the unselected contacts
        $contactsToDelete = $this->jiri->contactJiris->diff($this->jiriContactForm->selectedStudentContacts)->diff($this->jiriContactForm->selectedEvaluatorContacts);
        foreach ($contactsToDelete as $contact){
            $this->jiriContactForm->delete($this->jiri->id, $contact->id);
        }

        // Add the selected students contacts
        foreach ($this->jiriContactForm->selectedStudentContacts as $contact){
            $this->jiriContactForm->create($this->jiri->id, $contact->id, 'student');
        }// Add the selected evaluators contacts
        foreach ($this->jiriContactForm->selectedEvaluatorContacts as $contact){
            $this->jiriContactForm->create($this->jiri->id, $contact->id, 'evaluator');
        }
        $this->successJiriContact = true;
    }
}
