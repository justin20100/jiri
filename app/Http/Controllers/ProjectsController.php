<?php

namespace App\Http\Controllers;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $projects = $user->projects()->get();

        return view('projects.index', compact('user','projects'));
    }
}
