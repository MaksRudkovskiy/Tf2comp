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
        $characters = Character::all();
        $items = Item::with('characters')->latest()->get();
        return view('admin.sections.items.index', compact('items', 'characters'));
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
            'caption' => 'nullable|string|max:100',
            'description' => 'required|string',
            'show_upside' => 'boolean',
            'upside' => 'nullable|string|required_if:show_upside,true',
            'show_downside' => 'boolean',
            'downside' => 'nullable|string|required_if:show_downside,true',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'characters' => 'required|array|min:1',
            'characters.*' => 'exists:characters,id',
        ]);

        $imagePath = $request->file('image')->store('items', 'public');

        $item = Item::create([
            'name' => $validated['name'],
            'caption' => $validated['caption'],
            'description' => $validated['description'],
            'show_upside' => $validated['show_upside'],
            'upside' => $validated['show_upside'] ? $validated['upside'] : null,
            'show_downside' => $validated['show_downside'],
            'downside' => $validated['show_downside'] ? $validated['downside'] : null,
            'image_path' => $imagePath,
        ]);

        $item->characters()->sync($validated['characters']);

        return redirect()->route('admin.items')->with('success', 'Предмет добавлен!');
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'caption' => 'nullable|string|max:100',
            'description' => 'required|string',
            'show_upside' => 'boolean',
            'upside' => 'nullable|string|required_if:show_upside,true',
            'show_downside' => 'boolean',
            'downside' => 'nullable|string|required_if:show_downside,true',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
            'characters' => 'required|array|min:1',
            'characters.*' => 'exists:characters,id',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image_path) {
                Storage::disk('public')->delete($item->image_path);
            }
            $imagePath = $request->file('image')->store('items', 'public');
            $validated['image_path'] = $imagePath;
        }

        $item->update([
                'name' => $validated['name'],
                'caption' => $validated['caption'],
                'description' => $validated['description'],
                'show_upside' => $validated['show_upside'],
                'upside' => $validated['show_upside'] ? $validated['upside'] : null,
                'show_downside' => $validated['show_downside'],
                'downside' => $validated['show_downside'] ? $validated['downside'] : null,
            ] + (isset($validated['image_path']) ? ['image_path' => $validated['image_path']] : []));

        $item->characters()->sync($validated['characters']);

        return redirect()->route('admin.items')->with('success', 'Предмет обновлен!');
    }

    // Форма редактирования
    public function edit(Item $item)
    {
        $characters = Character::all();
        $item->load('characters');
        return view('admin.sections.items.edit', compact('item', 'characters'));
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
