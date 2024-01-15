<?php

namespace App\Livewire\Jiris;

use App\Models\Jiri;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class JiriList extends Component
{
    use WithPagination;
    public $jiris;
    protected $listeners = ['refreshJiriList' => 'refreshJiriList'];
    public array $selectedJiris = [];
    public bool $actionsDisabled = true;

    public function mount(): void
    {
        $this->jiris = Auth::user()->jiris()->orderBy('start', 'desc')->paginate(10)->getCollection();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedJiris) < 1;
        $this->mount();
        return view('livewire.jiris.jiri-list');
    }

    public function refreshJiriList(): void
    {
        $this->jiris = Auth::user()->jiris()->orderBy('start', 'desc')->paginate(10)->getCollection();
    }

    public function cancelSelected(): void
    {
        $this->selectedJiris = [];
    }

    public function deleteSelected(): void
    {
        foreach ($this->selectedJiris as $jiriId) {
            $this->deleteJiri($jiriId);
        }

        $this->selectedJiris = [];
        $this->refreshJiriList();
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
