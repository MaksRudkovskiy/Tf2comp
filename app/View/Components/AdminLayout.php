<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    public function render(): \Illuminate\View\View
    {
        return view('layouts.admin');
    }
}
