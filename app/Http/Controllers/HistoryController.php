<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function histories()
    {
        $histories = Article::where('type', 'history')->latest()->get();
        return view('pages.histories', compact('histories'));
    }

    public function history($id)
    {
        $history = Article::where('type', 'history')->findOrFail($id);
        return view('pages.history', compact('history'));
    }
}
