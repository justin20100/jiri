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
        return view('jiris.index');
    }

    public function create()
    {
        return view('jiris.create');
    }
}
