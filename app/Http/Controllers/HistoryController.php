<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // Публичная часть (показать список)
    public function histories()
    {
        $histories = Article::where('type', 'history')->latest()->get();
        return view('pages.histories', compact('histories'));
    }

    // Публичная часть (показать одну)
    public function history($id)
    {
        $history = Article::where('type', 'history')->findOrFail($id);
        return view('pages.history', compact('history'));
    }

    // Админка - список
    public function index(Request $request)
    {
        $search = $request->input('search');

        $histories = Article::where('type', 'history')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'history')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'history');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.histories.index', compact('histories'));
    }

    // Админка - форма создания
    public function create()
    {
        return view('admin.sections.histories.create');
    }

    // Админка - сохранить новую
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        Article::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'type' => 'history',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.histories')->with('success', 'История добавлена!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $history = Article::where('type', 'history')->findOrFail($id);
        return view('admin.sections.histories.edit', compact('history'));
    }

    // Админка - обновить
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $history = Article::where('type', 'history')->findOrFail($id);
        $history->update($validated);

        return redirect()->route('admin.histories')->with('success', 'История обновлена!');
    }

    // Админка - удалить
    public function destroy($id)
    {
        $history = Article::where('type', 'history')->findOrFail($id);
        $history->delete();

        return redirect()->route('admin.histories')->with('success', 'История удалена!');
    }
}
