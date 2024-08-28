<?php

namespace App\Livewire\Forms;

use App\Models\ContactJiri;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JiriContactForm extends Form
{
    #[Validate('required')]
    public $selectedStudentContacts = [];
    public $selectedEvaluatorContacts = [];

    public function rules(): array
    {
        return [
            'selectedStudentContacts' => ['required', 'min:1'],
            'selectedEvaluatorContacts' => ['required', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'selectedStudentContacts.required' => 'You need to select at least one student contact.',
            'selectedStudentContacts.min' => 'You need to select at least one student contact.',
            'selectedEvaluatorContacts.required' => 'You need to select at least one evaluator contact.',
            'selectedEvaluatorContacts.min' => 'You need to select at least one evaluator contact.',
        ];
    }

    public function create($jiriId, $contactId, $role): void
    {
        $this->validate();
        ContactJiri::create(['jiri_id' => $jiriId, 'contact_id' => $contactId, 'role' => $role]);
    }

    public function delete($jiriId, $contactId): void
    {
        $this->validate();
        ContactJiri::where('jiri_id', $jiriId)->where('contact_id', $contactId)->delete();
    }
}
