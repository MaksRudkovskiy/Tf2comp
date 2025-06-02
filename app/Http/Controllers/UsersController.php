<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mistake;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.sections.users');
    }
}
