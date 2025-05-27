<?php

namespace App\Http\Controllers;

use App\Models\Mistake;
use Illuminate\Http\Request;

class MistakeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:2000',
            'date' => 'required|date',
            'user_id' => 'nullable|exists:users,id'
        ]);

        Mistake::create($validated);

        return back()->with('status', 'error-reported');
    }
}
