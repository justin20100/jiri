<?php
namespace App\Livewire\Jiri;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class JiriCreate extends Component
{
    public $projects;
    public $contacts;
    protected $listeners = [
        'refreshProjectList' => 'refreshProjectList',
        'refreshContactList' => 'refreshContactList',
    ];
    public $selectedProjects;
    public $selectedContacts;
    public bool $actionsDisabled = true;

    public function mount(): void
    {
        $this->projects = Auth::user()->projects()->orderby('created_at', 'desc')->get();
        $this->contacts = Auth::user()->contacts()->orderby('created_at', 'desc')->get();
        $this->selectedProjects = collect();
        $this->selectedContacts = collect();
    }

    #[Computed]
    public function projects(): array
    {
        return Auth::user()->projects()->orderby('created_at', 'desc')->get();
    }

    public function contacts(): array
    {
        return Auth::user()->contacts()->orderby('created_at', 'desc')->get();
    }

    public function selectedProjects(): array
    {

    }

    public function selectedContacts(): array
    {

    }


    public function render()
    {
        return view('livewire.jiris.jiri-create');
    }

    public function refreshProjectList(): void
    {
        $this->projects = Auth::user()->projects()->orderBy('created_at', 'desc')->get();
    }

    public function refreshContactList(): void
    {
        $this->contacts = Auth::user()->contacts()->orderBy('created_at', 'desc')->get();
    }

    public function selectProject($projectId): void
    {
        $selectedProject = Project::findOrFail($projectId);

        $this->removeProjectFromCollection($this->projects, $selectedProject);
        $this->selectedProjects->push($selectedProject);
    }

    public function removeProject($projectId): void
    {
        $selectedProject = Project::find($projectId);

        $this->removeProjectFromCollection($this->selectedProjects, $selectedProject);
        $this->projects->push($selectedProject);
    }

    protected function removeProjectFromCollection(&$collection, $selectedProject): void
    {
        $collection = $collection->filter(function ($project) use ($selectedProject) {
            return $project->id !== $selectedProject->id;
        });
    }

    public function removecontact($contactId): void
    {
        $this->selectedContacts = array_diff($this->selectedContacts, [$contactId]);
    }

    public function deleteJiri($jiriId): void
    {
        $jiri = Jiri::findOrFail($jiriId);

        foreach ($jiri->jiriProjects as $jiriProject) {
            $jiriProject->contactDuties()->delete();
        }

        $jiri->contactJiris()->delete();
        $jiri->jiriProjects()->delete();
        $jiri->delete();

        $this->refreshJiriList();
    }
}
