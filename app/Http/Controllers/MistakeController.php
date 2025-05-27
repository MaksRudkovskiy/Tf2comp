<?php

namespace App\Http\Controllers;

use App\Models\Mistake;
use Illuminate\Http\Request;

class MistakeController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->check()) {
            $alreadySubmitted = Mistake::where('user_id', auth()->id())
                ->whereDate('created_at', today())
                ->exists();

            if ($alreadySubmitted) {
                return back()->with('error', 'Вы уже отправляли сообщение об ошибке сегодня');
            }
        }

        $validated = $request->validate([
            'text' => 'required|string|max:2000',
            'date' => 'required|date',
            'user_id' => 'nullable|exists:users,id'
        ]);

        Mistake::create($validated);

        return back()->with('status', 'error-reported');
    }
}
