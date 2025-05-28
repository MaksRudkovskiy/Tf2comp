<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        $characters = Character::all();
        return view('admin.admin', compact('characters'));
    }
}
