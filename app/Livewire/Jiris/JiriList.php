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
    protected $listeners = ['refreshJiriList' => 'refreshJiriList', 'confirmed' => 'onConfirmed', 'cancelled' => 'onCancelled'];
    public array $selectedJiris = [];
    public bool $actionsDisabled = true;
    public array $jiriToDelete = [];

    public function mount(): void
    {
        $this->jiris = Auth::user()->jiris()->orderBy('start', 'desc')->get();
    }

    public function render()
    {
        $this->actionsDisabled = count($this->selectedJiris) < 1;
        $this->mount();
        return view('livewire.jiris.jiri-list');
    }

    public function refreshJiriList(): void
    {
        $this->jiris = Auth::user()->jiris()->orderBy('start', 'desc')->get();
    }

    public function cancelSelected(): void
    {
        $this->selectedJiris = [];
    }

    public function deleteSelected(): void
    {
        $this->jiriToDelete = $this->selectedJiris;
        $this->dispatch('checkConfirm', 'Are you sure you want to delete the selected jiris?');
    }

    public function deleteJiri($jiriId): void
    {
        $this->jiriToDelete = [$jiriId];
        $this->dispatch('checkConfirm', 'Are you sure you want to delete this jiri?');
    }

    public function onConfirmed(): void
    {
        foreach ($this->jiriToDelete as $jiriId) {
            $jiri = Jiri::findOrFail($jiriId);
            foreach ($jiri->jiriProjects as $jiriProject) {
                $jiriProject->contactDuties()->delete();
            }
            $jiri->contactJiris()->delete();
            $jiri->jiriProjects()->delete();
            $jiri->delete();
        }
        $this->selectedJiris = [];
        $this->refreshJiriList();
    }

    public function onCancelled(): void
    {
        $this->jiriToDelete = [];
    }
}
