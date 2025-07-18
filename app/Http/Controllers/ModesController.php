<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ModesController extends Controller
{
    public function index()
    {
        $modes = Article::where('type', 'mode')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

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
    public function AdminIndex(Request $request)
    {
        $search = $request->input('search');

        $modes = Article::where('type', 'mode')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'mode')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'mode');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

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
            'title' => 'required|string|max:45',
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
            'title' => 'required|string|max:45',
            'text' => 'required|string',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'user_id' => auth()->id() // Добавляем текущего пользователя как редактора
        ]);

        return redirect()->route('admin.bugs')->with('success', 'Статья обновлена!');
    }


    // Админка - удаление
    public function destroy($id)
    {
        $mode = Article::where('type', 'mode')->findOrFail($id);
        $mode->delete();

        return redirect()->route('admin.modes')->with('success', 'Режим удален!');
    }
}
