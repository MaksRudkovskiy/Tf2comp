<?php

namespace App\Http\Controllers;

use App\Models\Mistake;
use Illuminate\Http\Request;

class MistakeController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', 'Пожалуйста, авторизуйтесь, чтобы отправить сообщение об ошибке.');
        }

        if (auth()->user()->isBanned()) {
            return back()->with('error', 'Ваш аккаунт заблокирован. Вы не можете отправлять сообщения об ошибках.');
        }

        $alreadySubmitted = Mistake::where('user_id', auth()->id())
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadySubmitted) {
            return back()->with('error', 'Вы уже отправляли сообщение об ошибке сегодня');
        }

        $validated = $request->validate([
            'text' => 'required|string|max:2000',
        ]);

        Mistake::create([
            'text' => $validated['text'],
            'user_id' => auth()->id(),
            'status' => 'pending'
        ]);

        return back()->with('status', 'error-reported');
    }

    public function update(Request $request, Mistake $mistake)
    {
        $request->validate([
            'status' => 'required|in:pending,declined,acknowledged,fixed'
        ]);

        $mistake->update(['status' => $request->status]);

        return back()->with('success', 'Статус обновлен');
    }

    public function destroy(Mistake $mistake)
    {
        $mistake->delete();
        return back()->with('success', 'Сообщение удалено');
    }
}
