<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminItemController extends Controller
{
    // Список всех предметов
    public function index()
    {
        $items = Item::with('characters')->latest()->get();
        return view('admin.sections.items.index', compact('items'));
    }

    // Форма создания
    public function create()
    {
        $characters = Character::all();
        return view('admin.sections.items.create', compact('characters'));
    }

    // Сохранение нового предмета
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string',
            'upside' => 'nullable|string',
            'downside' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'characters' => 'required|array',
            'characters.*' => 'exists:characters,id',
        ]);

        // Сохраняем изображение
        $imagePath = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'upside' => $validated['upside'],
            'downside' => $validated['downside'],
            'image_path' => $imagePath,
        ]);

        // Привязываем персонажей
        $item->characters()->sync($validated['characters']);

        return redirect()->route('admin.items')->with('success', 'Предмет добавлен!');
    }

    // Форма редактирования
    public function edit(Item $item)
    {
        $characters = Character::all();
        $item->load('characters');
        return view('admin.sections.items.edit', compact('item', 'characters'));
    }

    // Обновление предмета
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'required|string',
            'upside' => 'nullable|string',
            'downside' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'characters' => 'required|array',
            'characters.*' => 'exists:characters,id',
        ]);

        // Обновляем изображение, если загружено новое
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }

            $imagePath = $request->file('image')->store('items', 'public');
            $validated['image_path'] = $imagePath;
        }

        $item->update($validated);
        $item->characters()->sync($validated['characters']);

        return redirect()->route('admin.items')->with('success', 'Предмет обновлен!');
    }

    // Удаление предмета
    public function destroy(Item $item)
    {
        // Удаляем изображение
        if ($item->image_path) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->characters()->detach();
        $item->delete();

        return redirect()->route('admin.items')->with('success', 'Предмет удален!');
    }
}
