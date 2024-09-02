<?php

namespace App\Livewire\Jiri;

use App\Livewire\Forms\JiriInfosForm;
use App\Models\Jiri;
use DateTime;
use Livewire\Component;

class JiriShowModal extends Component
{
    public $jiriShowIsOpen = "";
    public Jiri $jiri;
    public $projects;
    public $contacts;
    public $evaluators;
    public $students;

    protected $listeners = ['openJiriShowModal' => 'openJiriShowModal', 'closeModal' => 'closeModal'];

    public function openJiriShowModal($jiriId): void
    {
        $this->jiri = Jiri::find($jiriId);

        $this->projects = $this->jiri->projects;

        $this->evaluators = $this->jiri->contacts->where('pivot.role', 'evaluator');

        $this->students = $this->jiri->contacts->where('pivot.role', 'student');

        $this->jiriShowIsOpen = "show";
    }

    public JiriInfosForm $jiriInfosForm;
    public function openJiriUpdateInfosModal(): void
    {
        $this->jiriInfosForm->name = $this->jiri->name;
        $startDateTime = new DateTime($this->jiri->start);
        $endDateTime = new DateTime($this->jiri->end);
        $this->jiriInfosForm->start = $startDateTime->format("Y-m-d\TH:i");
        $this->jiriInfosForm->end = $endDateTime->format("Y-m-d\TH:i");
        $this->jiriShowIsOpen = "updateInfos";
    }
    public function updateJiriInfos (): void
    {

        $this->jiriInfosForm->update($this->jiri);
        $this->dispatch('flashMessage', 'success',__("Jiri infos successfully updated"), $this->jiri->name);
        $this->jiriShowIsOpen = "show";
    }

    public function closeJiriShowModal(): void
    {
        $this->reset('jiri', 'projects', 'contacts', 'evaluators', 'students', 'jiriShowIsOpen');
    }

    public function render()
    {
        return view('livewire.jiri.jiri-show-modal');
    }
}
