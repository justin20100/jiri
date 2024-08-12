<?php

namespace App\Livewire\Jiris;

use App\Models\Jiri;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class JiriList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshJiriList' => 'refreshJiriList', 'confirmed' => 'onConfirmed', 'cancelled' => 'onCancelled'];
    public array $selectedJiris = [];
    public bool $actionsDisabled = true;
    public array $jiriToDelete = [];

//    public function mount(): void
//    {
//    }

    #[Computed]
    public function jiris(){
        return Auth::user()->jiris()->orderBy('start', 'desc')->get();
    }

    public function render() : View
    {
        $this->actionsDisabled = count($this->selectedJiris) < 1;
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
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected jiris?'),
            message: __('If you delete the selected jiris, all related data will be lost but not the projects and the contacts.'));
    }
    public function deleteJiri($jiriId): void
    {
        $this->jiriToDelete = [$jiriId];
        $this->dispatch('checkConfirm',
            titleMessage: __('Are you sure you want to delete the selected jiris?'),
            message: __('If you delete the selected jiris, all related data will be lost but not the projects and the contacts.'));
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
