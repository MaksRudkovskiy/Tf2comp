<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Character;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function item(Request $request)
    {
        $search = $request->input('search');
        $characterId = $request->input('character');
        $selectedItemId = $request->input('selected_item');
        $page = $request->input('page', 1);

        $items = Item::query()
            ->when($search && $characterId, function($query) use ($search, $characterId) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                })
                    ->whereHas('characters', function($q) use ($characterId) {
                        $q->where('characters_id', $characterId);
                    });
            })
            ->when($search && !$characterId, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($characterId && !$search, function($query) use ($characterId) {
                $query->whereHas('characters', function($q) use ($characterId) {
                    $q->where('characters_id', $characterId);
                });
            })
            ->orderBy('name')
            ->paginate(16, ['*'], 'page', $page);

        $selectedItem = $selectedItemId
            ? Item::find($selectedItemId)
            : $items->first();

        $characters = Character::all();

        return view('pages.item', compact('items', 'characters', 'selectedItem', 'search'));
    }
}
