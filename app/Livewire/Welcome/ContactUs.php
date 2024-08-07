<?php

namespace App\Livewire\Welcome;

use App\Livewire\Forms\ContactUsForm;
use App\Livewire\Forms\ContactUsMail;
use App\Livewire\Forms\Mail;
use App\Livewire\Forms\Validate;
use Livewire\Component;

class ContactUs extends Component
{

    public ContactUsForm $form;


    public function submitForm()
    {
        // Validate form
        $this->validate();

        // Send email
         Mail::to(config('mail.from.address'))->send(new ContactUsMail($this->firstname, $this->lastname, $this->email, $this->message));

        // Flash message
        session()->flash('success', 'Your message has been sent successfully!');

        // Clear form
        $this->reset();
    }

    public function render()
    {
        return view('livewire.welcome.contact-us');
    }
}
