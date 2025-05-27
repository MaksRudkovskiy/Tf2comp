<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModesController extends Controller
{
    public function modes()
    {
        return view('pages.modes');
    }
}
