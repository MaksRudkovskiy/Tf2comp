<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ModesController extends Controller
{
    public function index()
    {
        $modes = Article::where('type', 'mode')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.modes', compact('modes'));
    }

    // Публичная страница
    public function modes(Request $request)
    {
        $search = $request->input('search');

        $modes = Article::where('type', 'modes')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'modes')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'modes');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.modes.index', compact('modes'));
    }

    // Админка - список режимов
    public function adminIndex()
    {
        $modes = Article::where('type', 'mode')
            ->latest()
            ->get();

        return view('admin.sections.modes.index', compact('modes'));
    }

    // Админка - форма создания
    public function create()
    {
        $modes = Article::where('type', 'mode')
            ->latest()
            ->get();

        return view('admin.sections.modes.create');
    }

    // Админка - сохранение
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        Article::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'type' => 'mode',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.modes')->with('success', 'Режим добавлен!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $mode = Article::where('type', 'mode')->findOrFail($id);
        return view('admin.sections.modes.edit', compact('mode'));
    }

    // Админка - обновление
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $mode = Article::where('type', 'mode')->findOrFail($id);
        $mode->update($validated);

        return redirect()->route('admin.modes')->with('success', 'Режим обновлен!');
    }

    // Админка - удаление
    public function destroy($id)
    {
        $mode = Article::where('type', 'mode')->findOrFail($id);
        $mode->delete();

        return redirect()->route('admin.modes')->with('success', 'Режим удален!');
    }
}
