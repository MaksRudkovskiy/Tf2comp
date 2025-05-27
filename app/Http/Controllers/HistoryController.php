<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function histories()
    {
        return view('pages.histories');
    }

    public function history()
    {
        return view('pages.history');
    }
}
