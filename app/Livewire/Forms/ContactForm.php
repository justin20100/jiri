<?php

namespace App\Livewire\Forms;

use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    use WithFileUploads;

    #[Validate('required|min:2|max:50')]
    public string $firstname = '';
    public string $lastname = '';

    #[Validate('required|email|min:3|max:50')]
    public string $email = '';

    #[Validate('image|max:1500|nullable')]
    public $avatar;

    public Contact $contact;

    public function setContact($contact): void
    {
        $this->contact = $contact;
        $this->firstname = $contact->firstname;
        $this->lastname = $contact->lastname;
        $this->email = $contact->email;
        $this->avatar = $contact->avatar;
    }

    public function create(): void
    {
        $this->validate();

        if ($this->avatar) {
            $this->avatar->store("public/avatars/");
        }

        auth()->user()->contacts()->create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'avatar' => $this->storeFile($this->avatar) ?? 'defaultavatar.jpg',
        ]);

        $this->reset(['firstname', 'lastname', 'email', 'avatar']);
    }

    public function update(): void
    {
        $this->validate();

        $this->contact->update([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'avatar' => $this->storeFile($this->avatar) ?? 'defaultavatar.jpg',
        ]);
    }

    protected function storeFile(UploadedFile $file = null): ?string
    {
        if (is_null($file)) {
            return null;
        }

        if ($file->isValid()) {
            $filename = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $filename);
            return $filename;
        } else {
            return null;
        }
    }

}
