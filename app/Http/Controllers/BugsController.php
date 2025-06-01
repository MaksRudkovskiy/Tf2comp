<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BugsController extends Controller
{
    // Публичная часть (показать список)
    public function bugs()
    {
        $bugs = Article::where('type', 'bug')
            ->latest()
            ->paginate(15);

        return view('pages.bugs_list', compact('bugs'));
    }

    // Публичная часть (показать одну)
    public function bugs_detail($id)
    {
        $bug = Article::where('type', 'bug')->findOrFail($id);
        return view('pages.bugs_detail', compact('bug'));
    }

    // Админка - список
    public function index(request $request)
    {
        $search = $request->input('search');

        $bugs = Article::where('type', 'bug')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")->where('type', 'bug')
                    ->orWhere('text', 'like', "%{$search}%")->where('type', 'bug');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.bugs.index', compact('bugs'));
    }

    // Админка - форма создания
    public function create()
    {
        return view('admin.sections.bugs.create');
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
            'type' => 'bug',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.bugs')->with('success', 'Статья добавлена!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $bug = Article::where('type', 'bug')->findOrFail($id);
        return view('admin.sections.bugs.edit', compact('bug'));
    }

    // Админка - обновить
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $bug = Article::where('type', 'bug')->findOrFail($id);
        $bug->update($validated);

        return redirect()->route('admin.bugs')->with('success', 'Статья обновлена!');
    }

    // Админка - удалить
    public function destroy($id)
    {
        $bug = Article::where('type', 'bug')->findOrFail($id);
        $bug->delete();

        return redirect()->route('admin.bugs')->with('success', 'Статья удалена!');
    }
}
