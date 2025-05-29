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
        return view('pages.character', compact('character'));
    }

    public function update(Request $request, Character $character)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'red_picture' => 'nullable|image|mimes:jpeg,png|max:2048',
            'blu_picture' => 'nullable|image|mimes:jpeg,png|max:2048'
        ]);

        $updateData = ['description' => $validated['description']];

        foreach (['red_picture', 'blu_picture'] as $field) {
            if ($request->hasFile($field)) {
                // Удаляем старое изображение (если оно не дефолтное)
                if ($character->$field && !str_starts_with($character->$field, 'characters/default/')) {
                    File::delete(public_path("storage/{$character->$field}"));
                }

                // Сохраняем новое изображение
                $filename = Str::random(40) . '.' . $request->file($field)->extension();
                $path = "characters/uploaded/{$filename}";
                $request->file($field)->move(public_path('storage/characters/uploaded'), $filename);

                $updateData[$field] = $path;
            }
        }

        $character->update($updateData);
        return back()->with('success', 'Изменения сохранены!');
    }
}
