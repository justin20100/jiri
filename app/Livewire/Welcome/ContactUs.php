<?php

namespace App\Livewire\Welcome;

use App\Livewire\Forms\ContactUsForm;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactUs extends Component
{
    public ContactUsForm $form;

    public function submitForm()
    {
        // Validate form
        $this->form->validate();
        // Send email to admin with the form data
        Mail::to('dev@justin-vincent.be')->send(new ContactUsMail($this->form->toArray()));
        // Flash message
        session()->flash('success');
        // Clear form
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.welcome.contact-us');
    }
}
