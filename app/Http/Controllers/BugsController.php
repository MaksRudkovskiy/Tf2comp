<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BugsController extends Controller
{
    public function bugs()
    {
        return view('pages.bugs_list');
    }

    public function bugs_detail()
    {
        return view('pages.bugs_detail');
    }


}
