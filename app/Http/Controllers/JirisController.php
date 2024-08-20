<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JirisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jiri.index');
    }

    public function create()
    {
        return view('jiri.create');
    }
}
