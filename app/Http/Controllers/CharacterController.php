<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function show($id)
    {
        $character = Character::findOrFail($id);
        return view('pages.character', compact('character'));
    }

    public function edit(Character $character)
    {
        return view('admin.characters.edit', compact('character'));
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
                // Удаляем старое, если оно не дефолтное
                if ($character->$field && !str_contains($character->$field, 'default/')) {
                    Storage::delete("public/{$character->$field}");
                }

                // Сохраняем новое в подпапку uploaded
                $path = $request->file($field)->store(
                    "public/characters/uploaded"
                );
                $updateData[$field] = str_replace('public/', '', $path);
            }
        }

        $character->update($updateData);
        return redirect()->back();
    }
}
