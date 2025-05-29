<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BugsController extends Controller
{
    public function bugs()
    {
        $bugs = Article::where('type', 'bug')->latest()->get();
        return view('pages.bugs_list', compact('bugs'));
    }

    public function bugs_detail($id)
    {
        $bug = Article::where('type', 'bug')->findOrFail($id);
        return view('pages.bugs_detail', compact('bug'));
    }
}
