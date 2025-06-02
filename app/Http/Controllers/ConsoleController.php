<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    // Публичная страница
    public function console()
    {
        $commands = Article::where('type', 'console')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.console', compact('commands'));
    }

    // Админка - список команд
    public function index(Request $request)
    {
        $search = $request->input('search');

        $commands = Article::where('type', 'console')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'console')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'console');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.console.index', compact('commands'));
    }

    // Админка - форма создания
    public function create()
    {
        return view('admin.sections.console.create');
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
            'type' => 'console',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.console')->with('success', 'Команда добавлена!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $command = Article::where('type', 'console')->findOrFail($id);
        return view('admin.sections.console.edit', compact('command'));
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
        $command = Article::where('type', 'console')->findOrFail($id);
        $command->delete();

        return redirect()->route('admin.console')->with('success', 'Команда удалена!');
    }
}
