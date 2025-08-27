<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplanationController extends Controller
{
    /**
     * Show the explanation page
     */
    public function index()
    {
        return view('explanation.index');
    }
}
