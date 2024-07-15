<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $contacts = $user->contacts()->get();

        return view('contacts.index', compact('user', 'contacts'));
    }
}
