<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Публичная страница
    public function blog()
    {
        $posts = Section::where('type', 'blog')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.blog', compact('posts'));
    }

    // Админка - список постов
    // BlogController.php
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Section::where('type', 'blog')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('text', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sections.blog.index', compact('posts'));
    }

    // Админка - форма создания
    public function create()
    {
        return view('admin.sections.blog.create');
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
            'type' => 'blog',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.blog')->with('success', 'Пост добавлен!');
    }

    // Админка - форма редактирования
    public function edit($id)
    {
        $post = Section::where('type', 'blog')->findOrFail($id);
        return view('admin.sections.blog.edit', compact('post'));
    }

    // Админка - обновление
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'text' => 'required|string',
        ]);

        $post = Section::where('type', 'blog')->findOrFail($id);
        $post->update($validated);

        return redirect()->route('admin.blog')->with('success', 'Пост обновлен!');
    }

    // Админка - удаление
    public function destroy($id)
    {
        $post = Section::where('type', 'blog')->findOrFail($id);
        $post->delete();

        return redirect()->route('admin.blog')->with('success', 'Пост удален!');
    }
}
