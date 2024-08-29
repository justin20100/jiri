<?php

namespace App\Livewire\Forms;

use App\Models\ContactJiri;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JiriStudentForm extends Form
{
    #[Validate('required')]
    public $selectedStudent = [];

    public function rules(): array
    {
        return [
            'selectedStudent' => ['required', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'selectedStudent.required' => 'You need to select at least one student contact.',
            'selectedStudent.min' => 'You need to select at least one student contact.',
        ];
    }

    public function create($jiriId, $contactId): void
    {
        $this->validate();
        ContactJiri::create(['jiri_id' => $jiriId, 'contact_id' => $contactId, 'role' => "student"]);
    }

    public function delete($jiriId, $contactId): void
    {
        $this->validate();
        ContactJiri::where('jiri_id', $jiriId)->where('contact_id', $contactId)->delete();
    }
}
