<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class ChangesController extends Controller
{
    // Публичная страница
    public function changes()
    {
        $changes = Section::where('type', 'changelog')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.changes', compact('changes'));
    }

    // Админка - список изменений
    public function index(Request $request)
    {
        $search = $request->input('search');

        $changes = Section::where('type', 'changelog')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'changelog')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'changelog');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.changes.index', compact('changes'));
    }

    // Админка - форма создания
    public function create()
    {
        return view('admin.sections.changes.create');
    }

    // Админка - сохранение
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        Section::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'type' => 'changelog',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.changes')->with('success', 'Изменение добавлено!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $change = Section::where('type', 'changelog')->findOrFail($id);
        return view('admin.sections.changes.edit', compact('change'));
    }

    // Админка - обновление
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $change = Section::where('type', 'changelog')->findOrFail($id);
        $change->update($validated);

        return redirect()->route('admin.changes')->with('success', 'Изменение обновлено!');
    }

    // Админка - удаление
    public function destroy($id)
    {
        $change = Section::where('type', 'changelog')->findOrFail($id);
        $change->delete();

        return redirect()->route('admin.changes')->with('success', 'Изменение удалено!');
    }
}
