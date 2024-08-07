<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactUsForm extends Form
{
    #[Validate('required|min:3|max:255')]
    public string $firstname;

    #[Validate('required|min:3|max:255')]
    public string $lastname;

    #[Validate('required|email|max:255')]
    public string $email;

    #[Validate('required|min:3|max:300')]
    public string $message;
}
