<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangesController extends Controller
{
    public function changes()
    {
        return view('pages.changes');
    }
}
