<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CharacterController extends Controller
{
    public function show($id)
    {
        $character = Character::findOrFail($id);
        $allCharacters = Character::orderBy('id')->get(); // Получаем всех персонажей для навигации

        return view('pages.character', compact('character', 'allCharacters'));
    }

    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'red_picture' => 'nullable|image|mimes:jpeg,png|max:2048',
            'blu_picture' => 'nullable|image|mimes:jpeg,png|max:2048'
        ]);

        $updateData = ['description' => $validated['description'], 'user_id' => auth()->id()];

        foreach (['red_picture', 'blu_picture'] as $field) {
            if ($request->hasFile($field)) {
                // Удаляем старое изображение (если оно не дефолтное)
                if ($character->$field && !str_starts_with($character->$field, 'characters/default/')) {
                    Storage::disk('public')->delete($character->$field);
                }

                // Сохраняем новое изображение
                $path = $request->file($field)->store('characters/uploaded', 'public');
                $updateData[$field] = $path;
            }
        }

        $character->update($updateData);
        return back()->with('success', 'Изменения сохранены!');
    }
}
