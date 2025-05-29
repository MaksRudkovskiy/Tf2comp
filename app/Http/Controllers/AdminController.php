<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Mistake;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        $characters = Character::all();
        return view('admin.admin', compact('characters'));
    }

    public function character(Character $character)
    {
        return view('admin.sections.characters', compact('character'));
    }

    public function items()
    {
        return view('admin.sections.items');
    }

    public function bugs()
    {
        return view('admin.sections.bugs');
    }

    public function modes()
    {
        return view('admin.sections.modes');
    }

    public function history()
    {
        return view('admin.sections.history');
    }

    public function console()
    {
        return view('admin.sections.console');
    }

    public function changes()
    {
        return view('admin.sections.changes');
    }

    public function blog()
    {
        return view('admin.sections.blog');
    }

    public function mistakes()
    {
        $mistakes = Mistake::with('user')->latest()->get();
        return view('admin.sections.mistakes', compact('mistakes'));
    }
}
