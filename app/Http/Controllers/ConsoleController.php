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
            ->get();

        return view('pages.console', compact('commands'));
    }

    // Админка - список команд
    public function index()
    {
        $commands = Article::where('type', 'console')
            ->latest()
            ->get();

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
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        Article::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'type' => 'console'
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
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $command = Article::where('type', 'console')->findOrFail($id);
        $command->update($validated);

        return redirect()->route('admin.console')->with('success', 'Команда обновлена!');
    }

    // Админка - удаление
    public function destroy($id)
    {
        $command = Article::where('type', 'console')->findOrFail($id);
        $command->delete();

        return redirect()->route('admin.console')->with('success', 'Команда удалена!');
    }
}
